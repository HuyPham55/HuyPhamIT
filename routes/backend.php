<?php

use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\DashBoardController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\FileController;
use App\Http\Controllers\Backend\HomeSlideController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\OptionController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PermissionGroupController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\StaticPageController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\TwoFactorAuthenticationController;
use App\Http\Controllers\Backend\UserController;
use App\Models\StaticPage;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {


    /*
        Only uncomment if config/lfm->use_package_routes set to false
        Also affect rich text editors
    */
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::get("translations", function() {
        return redirect("/translations");
    });


    //Permission groups
    Route::group(['prefix' => 'permission-groups'], function () {
        Route::get('list', [PermissionGroupController::class, 'getList'])
            ->middleware('permission:show_list_permission_groups')
            ->name('permission_groups.list');

        Route::group(['middleware' => 'permission:add_permission_groups'], function () {
            Route::get('add', [PermissionGroupController::class, 'getAdd'])->name('permission_groups.add');
            Route::post('add', [PermissionGroupController::class, 'postAdd']);
        });
        Route::group(['middleware' => 'permission:edit_permission_groups'], function () {
            Route::get('edit/{id}', [PermissionGroupController::class, 'getEdit'])
                ->name('permission_groups.edit');
            Route::put('edit/{id}', [PermissionGroupController::class, 'putEdit']);
        });
        Route::post('delete', [PermissionGroupController::class, 'delete'])
            ->middleware('permission:delete_permission_groups')
            ->name('permission_groups.delete');
    });

    //Permissions
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('list', [PermissionController::class, 'getList'])
            ->middleware('permission:show_list_permissions')
            ->name('permissions.list');

        Route::group(['middleware' => 'permission:add_permissions'], function () {
            Route::get('add', [PermissionController::class, 'getAdd'])
                ->name('permissions.add');
            Route::post('add', [PermissionController::class, 'postAdd']);
        });

        Route::group(['middleware' => 'permission:edit_permissions'], function () {
            Route::get('edit/{id}', [PermissionController::class, 'getEdit'])
                ->name('permissions.edit');
            Route::put('edit/{id}', [PermissionController::class, 'putEdit']);
        });

        Route::post('delete', [PermissionController::class, 'delete'])
            ->middleware('permission:delete_permissions')
            ->name('permissions.delete');
    });

    Route::group(['prefix' => 'media'], function () {
        Route::get('/', [MediaController::class, 'getList'])->name('media.list');
    });

    Route::group(['prefix' => 'files'], function () {
        Route::get('/', [FileController::class, 'getList'])->name('files.list');
    });

    Route::get('dashboard', [DashBoardController::class, 'index'])->name('dashboard');

    //Settings
    Route::group(['prefix' => 'settings'], function () {
        //Banners
        Route::group(['prefix' => 'banner'], function () {
            Route::group(['middleware' => 'can:change_banners'], function () {
                Route::get('/', [BannerController::class, 'getEdit'])->name('settings.banner');
                Route::put('/', [BannerController::class, 'putEdit']);
            });
        });

        //Options
        Route::group(['prefix' => 'options'], function () {
            Route::group(['middleware' => 'permission:change_website_settings'], function () {
                Route::get('/', [OptionController::class, 'getEdit'])->name('settings.options');
                Route::put('/', [OptionController::class, 'putEdit']);
            });
        });
    });

    //Files
    Route::group(['prefix' => 'file'], function () {
        Route::post('/', [FileController::class, 'postImage'])->name('file.post_image');
    });

    //Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('list', [UserController::class, 'getList'])->middleware('can:show_list_users')->name('users.list');
        Route::group(['middleware' => 'can:add_users'], function () {
            Route::get('add', [UserController::class, 'getAdd'])->name('users.add');
            Route::post('add', [UserController::class, 'postAdd']);
        });
        Route::group(['middleware' => 'can:edit_users'], function () {
            Route::get('edit/{user}', [UserController::class, 'getEdit'])->name('users.edit');
            Route::put('edit/{user}', [UserController::class, 'postEdit']);
        });
        Route::post('delete', [UserController::class, 'delete'])->middleware('can:delete_users')->name('users.delete');
    });
    //User
    Route::group(['prefix' => 'user'], function () {
        Route::get('edit-profile', [UserController::class, 'getEditProfile'])->name('users.edit_profile');
        Route::put('edit-profile', [UserController::class, 'postEditProfile']);
        Route::get('change-password', [UserController::class, 'getChangePassword'])->name('users.change_password');
        Route::post('change-password', [UserController::class, 'postChangePassword']);

        //2FA
        Route::get('two-factor-authentication', [TwoFactorAuthenticationController::class, 'enable'])
            ->name('users.two-factor-authentication.enable')
            ->middleware(['password.confirm']);

        Route::post('two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])
            ->name('users.two-factor-authentication.remove')
            ->middleware(['password.confirm']);
    });

    //Members
    Route::group(['prefix' => 'members'], function () {
        Route::get('/', [MemberController::class, 'index'])
            ->middleware('permission:show_list_members')->name('members.list');
        Route::group(['middleware' => 'permission:add_members'], function () {
            Route::get('add', [MemberController::class, 'getAdd'])->name('members.add');
            Route::post('add', [MemberController::class, 'postAdd']);
        });
        Route::group(['middleware' => 'permission:edit_members'], function () {
            Route::get('{id}/edit', [MemberController::class, 'getEdit'])->name('members.edit');
            Route::put('{id}/edit', [MemberController::class, 'putEdit']);
        });
        Route::post('delete', [MemberController::class, 'delete'])
            ->middleware('permission:delete_members')->name('members.delete');
    });


    //Roles
    Route::group(['prefix' => 'role'], function () {
        Route::get('list', [RoleController::class, 'index'])
            ->middleware('can:show_list_roles')->name('roles.list');
        Route::group(['middleware' => 'can:add_roles'], function () {
            Route::get('add', [RoleController::class, 'getAdd'])->name('roles.add');
            Route::post('add', [RoleController::class, 'postAdd']);
        });
        Route::group(['middleware' => 'can:edit_roles'], function () {
            Route::get('edit/{id}', [RoleController::class, 'getEdit'])->name('roles.edit')
                ->where(['id' => '[0-9]+']);
            Route::put('edit/{id}', [RoleController::class, 'postEdit'])
                ->where(['id' => '[0-9]+']);
        });
        Route::post('delete', [RoleController::class, 'delete'])
            ->middleware('can:delete_roles')->name('roles.delete');
    });

    //Home slide
    Route::group(['prefix' => 'home-slides'], function () {
        Route::get('/', [HomeSlideController::class, 'index'])
            ->middleware('permission:show_list_home_slides')->name('home_slides.list');
        Route::group(['middleware' => 'permission:add_home_slides'], function () {
            Route::get('add', [HomeSlideController::class, 'getAdd'])->name('home_slides.add');
            Route::post('add', [HomeSlideController::class, 'postAdd']);
        });
        Route::group(['middleware' => 'permission:edit_home_slides'], function () {
            Route::get('edit/{id}', [HomeSlideController::class, 'getEdit'])->name('home_slides.edit');
            Route::put('edit/{id}', [HomeSlideController::class, 'putEdit']);

            Route::post('change-sorting', [HomeSlideController::class, 'changeSorting'])->name('home_slides.change_sorting');
            Route::post('change-status', [HomeSlideController::class, 'changeStatus'])->name('home_slides.change_status');
        });
        Route::post('delete', [HomeSlideController::class, 'delete'])
            ->middleware('permission:delete_home_slides')->name('home_slides.delete');
    });

    //post
    Route::group(['prefix' => 'posts'], function () {
        //Post Category
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [PostCategoryController::class, 'index'])
                ->middleware('permission:show_list_post_categories')
                ->name('post_categories.list');
            Route::group(['middleware' => 'permission:add_post_categories'], function () {
                Route::get('add', [PostCategoryController::class, 'getAdd'])
                    ->name('post_categories.add');
                Route::post('add', [PostCategoryController::class, 'postAdd']);
            });
            Route::group(['middleware' => 'permission:edit_post_categories'], function () {
                Route::get('edit/{id}', [PostCategoryController::class, 'getEdit'])
                    ->name('post_categories.edit');
                Route::put('edit/{id}', [PostCategoryController::class, 'putEdit']);

                Route::post('change-sorting', [PostCategoryController::class, 'changeSorting'])
                    ->name('post_categories.change_sorting');
                Route::post('change-status', [PostCategoryController::class, 'changeStatus'])
                    ->name('post_categories.change_status');
            });
            Route::post('delete', [PostCategoryController::class, 'delete'])
                ->middleware('permission:delete_post_categories')
                ->name('post_categories.delete');
        });

        //Posts
        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', [PostController::class, 'index'])
                ->middleware('permission:show_list_posts')->name('posts.list');
            Route::get('/datatables', [PostController::class, 'datatables'])
                ->middleware('permission:show_list_posts')
                ->name('posts.datatables');

            Route::put('/', [PostController::class, 'updateStaticPage']);

            Route::group(['middleware' => 'permission:add_posts'], function () {
                Route::get('add', [PostController::class, 'getAdd'])->name('posts.add');
                Route::post('add', [PostController::class, 'postAdd']);
            });
            Route::group(['middleware' => 'permission:edit_posts'], function () {
                Route::get('edit/{post}', [PostController::class, 'getEdit'])->name('posts.edit');
                Route::put('edit/{post}', [PostController::class, 'putEdit']);

                Route::patch('change-status/{post?}', [PostController::class, 'changeStatus'])->name('posts.change_status');
                Route::patch('change-sorting/{post?}', [PostController::class, 'changeSorting'])->name('posts.change_sorting');
            });
            Route::delete('delete/{post}', [PostController::class, 'delete'])
                ->middleware('permission:delete_posts')->name('posts.delete');
        });
    });

    //Static pages
    Route::group([
        'prefix' => 'static-pages',
        'middleware' => 'permission:update_home_page|update_about_page|update_contact_page|update_404_page'
    ], function () {
        $arrKey = implode("|", StaticPage::AVAILABLE_PAGES);
        Route::get('/{key}', [StaticPageController::class, 'getEdit'])
            ->where('key', $arrKey)
            ->name('backend.static_page');

        $keySeo = implode("|", StaticPage::AVAILABLE_SEO_PAGES);
        Route::get('/{keySeo}', [StaticPageController::class, 'getEditSeoPage'])
            ->where('keySeo', $keySeo)
            ->name('backend.seo_page');

        $arrKeyAccept = implode("|", array_merge(StaticPage::AVAILABLE_PAGES, StaticPage::AVAILABLE_SEO_PAGES));
        Route::put('/{key}', [StaticPageController::class, 'putEdit'])
            ->where('key', $arrKeyAccept);
    });

    //Faqs
    Route::group(['prefix' => 'faqs'], function () {
        Route::get('/', [FaqController::class, 'index'])
            ->middleware('permission:show_list_faqs')->name('faqs.list');
        Route::group(['middleware' => 'permission:add_faqs'], function () {
            Route::get('add', [FaqController::class, 'getAdd'])->name('faqs.add');
            Route::post('add', [FaqController::class, 'postAdd']);
        });
        Route::group(['middleware' => 'permission:edit_faqs'], function () {
            Route::get('edit/{id}', [FaqController::class, 'getEdit'])->name('faqs.edit');
            Route::put('edit/{id}', [FaqController::class, 'putEdit']);

            Route::post('change-sorting', [FaqController::class, 'changeSorting'])->name('faqs.change_sorting');
            Route::post('change-status', [FaqController::class, 'changeStatus'])->name('faqs.change_status');
        });
        Route::post('delete', [FaqController::class, 'delete'])
            ->middleware('permission:delete_faqs')->name('faqs.delete');
    });

    //Contact
    Route::group(['prefix' => 'contacts'], function () {
        Route::get('/', [ContactController::class, 'index'])
            ->middleware('permission:show_list_contacts')->name('contacts.list');
        Route::get('/show', [ContactController::class, 'show'])->name('contacts.show');
        Route::post('delete', [ContactController::class, 'delete'])
            ->middleware('permission:delete_contacts')->name('contacts.delete');
        Route::post('change-favourite', [ContactController::class, 'changeFavourite'])->name('contacts.change_favourite');
    });


    //Tag
    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', [TagController::class, 'index'])->middleware('permission:show_list_tags')->name('tags.list');
        Route::get('/datatables', [TagController::class, 'datatables'])
            ->middleware('permission:show_list_tags')
            ->name('tags.datatables');

        Route::group(['middleware' => 'permission:add_tags'], function () {
            Route::get('add', [TagController::class, 'getAdd'])->name('tags.add');
            Route::post('add', [TagController::class, 'postAdd']);
        });
        Route::group(['middleware' => 'permission:edit_tags'], function () {
            Route::get('edit/{tag}', [TagController::class, 'getEdit'])
                ->name('tags.edit');
            Route::put('edit/{tag}', [TagController::class, 'putEdit']);
        });
        Route::delete('delete/{tag}', [TagController::class, 'delete'])
            ->middleware('permission:delete_tags')
            ->name('tags.delete');
    });

});
