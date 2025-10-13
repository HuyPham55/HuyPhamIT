<?php

namespace Tests\Feature\Comments\BaseTest;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;

abstract class CommentTestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Keep morph types short & deterministic in tests
        Relation::enforceMorphMap([
            'post' => \App\Models\Post::class,
        ]);
    }
}