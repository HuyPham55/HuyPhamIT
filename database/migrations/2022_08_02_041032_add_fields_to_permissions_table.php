<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
            $table->integer('permission_group_id')->nullable();
            $table->string('title')->after('name')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('sorting')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
            $table->dropColumn('permission_group_id');
            $table->dropColumn('title');
            $table->dropColumn('status');
            $table->dropColumn('sorting');
        });
    }
};
