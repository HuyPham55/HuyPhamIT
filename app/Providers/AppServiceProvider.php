<?php

namespace App\Providers;
use App\Contracts\Repositories\PostCategoryRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Repositories\TagRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\Frontend\PostServiceInterface as FrontendPostServiceContract;
use App\Contracts\Services\PostCategoryServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\TagServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use App\Services\Frontend\PostService as FrontendPostService;
use App\Services\PostCategoryService;
use App\Services\PostService;
use App\Services\TagService;
use App\Services\UserService;
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

        app()->bind(
            TagRepositoryInterface::class,
            TagRepository::class
        );

        app()->bind(
            TagServiceInterface::class,
            TagService::class
        );

        app()->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        app()->bind(
            UserServiceInterface::class,
            UserService::class
        );

        //Frontend
        app()->bind(
            FrontendPostServiceContract::class,
            FrontendPostService::class
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
        if (0) {

            \DB::listen(function ($query) {
                // Way 1
                $output = [$query->sql, $query->bindings, $query->time];
                file_put_contents(base_path() . '/storage/logs/dump_db_queries.txt',
                    var_export($output, true)
                    . PHP_EOL . '--------------------------------------------------------' . PHP_EOL,
                    FILE_APPEND);

                // Way 2
                $output = str_replace_array('?', $query->bindings, str_replace('?', "'?'", $query->sql)) . ';';
                file_put_contents(base_path() . '/storage/logs/dump_db_queries.sql',
                    $output
                    . PHP_EOL,
                    FILE_APPEND);

            });
        }
    }
}
