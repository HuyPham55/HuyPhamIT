<?php

namespace App\Providers;
use App\Contracts\Repositories\PostCategoryRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Services\PostCategoryServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;
use App\Services\PostCategoryService;
use App\Services\PostService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        app()->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );
        app()->bind(
            PostServiceInterface::class,
            PostService::class
        );
        app()->bind(
            PostCategoryRepositoryInterface::class,
            PostCategoryRepository::class
        );
        app()->bind(
            PostCategoryServiceInterface::class,
            PostCategoryService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        //Set default string() length for migration
        //Schema::defaultStringLength(512);

        //Set Bootstrap as default pagination template
        Paginator::useBootstrap();
    }
}
