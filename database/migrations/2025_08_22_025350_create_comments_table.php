<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * Set default string length to 32 for commentable because we use morphs() to create commentable_type and commentable_id
         */
        Schema::defaultStringLength(32);

        Schema::create('comments', function (Blueprint $table) {
            $table->ulid('id')->primary();;
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');

            // polymorphic owner: Post, Thread, ...
            $table->morphs('commentable'); // commentable_type (string, 32), commentable_id (bigint)

            // nesting
            $table->foreignUlid('parent_id')->nullable()->constrained('comments')->cascadeOnDelete();
            $table->string('path', 1024)->charset('ascii')->collation('ascii_bin');
            // materialized path, e.g. "00000f/0000a1/0000b3"
            // id segments joined by '/', e.g. "01J9.../01J9.../..."
            $table->unsignedSmallInteger('depth')->default(0);

            $table->text('content');
            $table->timestamps();
            $table->softDeletes();

            // Read-path indexes
            $table->index(['commentable_type', 'commentable_id', 'path'], 'comments_owner_path_idx'); // Composite index now fits under 3072 bytes
            $table->index('parent_id');   // quick children lookups
            $table->index(['commentable_type', 'commentable_id', 'created_at']); // latest-first lists
            $table->index('member_id');   // member activity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
