<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\admin\LogsController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\client\GoogleController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\client\FacebookController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\client\ProfileController as ClientProfileController;
use App\Http\Controllers\client\PostController as ClientPostController;
use App\Http\Controllers\client\SearchController as ClientSearchController;
// V? V?n Toàn
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    ['middleware' => ['prevent_back_history']],
    function () {
        // Client routes
        Route::middleware('guest')->group(function () {
            Route::get('/', function () {
                return view('auth.login');
            })->name('client.login');
            Route::prefix('auth')->group(function () {
                // Auth with facebook
                Route::get('facebook/redirect', [FacebookController::class, 'redirect'])->name('facebook.redirect');
                Route::get('facebook/callback', [FacebookController::class, 'callback'])->name('facebook.callback');
                // Auth with google
                Route::get('google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
                Route::get('google/callback', [GoogleController::class, 'callback'])->name('google.callback');
            });
        });
        Route::get('/', function () {
            return view('backend.client.home.home');
        })->name('home');
        Route::middleware(['auth'])->group(function () {
            Route::get('/logout', [ClientController::class, 'logout'])->name('client.logout');
        });

        Route::prefix('profile')->group(function () {
            Route::get('/{id}', [ClientProfileController::class, 'ClientProfileView'])->name('client.profile.view');
            Route::get('/{id}/edit', [ClientProfileController::class, 'ClientProfileEdit'])->name('client.profile.edit');
            Route::post('/{id}/update/data', [ClientProfileController::class, 'ClientProfileUpdateData'])->name('client.profile.update.data');
            Route::post('/{id}/update/password', [ClientProfileController::class, 'ClientProfileUpdatePassword'])->name('client.profile.update.password');
        });

        Route::prefix('post')->group(function () {
            Route::get('/{post:slug}', [ClientPostController::class, 'GetPost'])->name('client.post.view');
            Route::get('/category/{category:slug}', [ClientPostController::class, 'getPostByCategory'])->name('client.category.post.view');
        });

        Route::prefix('search')->group(function () {
            Route::get('/', [ClientSearchController::class, 'SearchView'])->name('client.search.view');
        });

        // Admin Route
        Route::prefix('admin')->group(function () {
            Route::get('/', function () {
                return view('auth.admin.login')->name('admin.login');
            })->middleware('guest');

            Route::get('/login', function () {
                return view('auth.admin.login');
            })->middleware('guest:admin')->name('admin.login');
            Route::post('/login', [AdminController::class, 'Login'])->name('admin.login');

            Route::middleware([
                'auth:admin'
            ])->group(function () {
                Route::get('/dashboard', function () {
                    return view('admin.index');
                })->name('admin.dashboard');
            });

            // Permission management routes
            Route::middleware(['auth:admin'])->prefix('permissions')->group(function () {
                Route::get('/view', [PermissionController::class, 'PermissionView'])->name('admin.permission.view');
                Route::get('/add', [PermissionController::class, 'PermissionAdd'])->name('admin.permission.add');
                Route::post('/store', [PermissionController::class, 'PermissionStore'])->name('admin.permission.store');
                Route::get('/edit/{id}', [PermissionController::class, 'PermissionEdit'])->name('admin.permission.edit');
                Route::post('/update/{id}', [PermissionController::class, 'PermissionUpdate'])->name('admin.permission.update');
                Route::get('/delete/{id}', [PermissionController::class, 'PermissionDelete'])->name('admin.permission.delete');
            });

            // Roles management routes
            Route::middleware(['auth:admin'])->prefix('roles')->group(function () {
                Route::get('/view', [RoleController::class, 'RoleView'])->name('admin.role.view');
                Route::get('/add', [RoleController::class, 'RoleAdd'])->name('admin.role.add');
                Route::get('/permissions', [RoleController::class, 'RolePermission'])->name('admin.role.permission');
                Route::post('/store', [RoleController::class, 'RoleStore'])->name('admin.role.store');
                Route::get('/edit/{id}', [RoleController::class, 'RoleEdit'])->name('admin.role.edit');
                Route::post('/update/{id}', [RoleController::class, 'RoleUpdate'])->name('admin.role.update');
                Route::get('/delete/{id}', [RoleController::class, 'RoleDelete'])->name('admin.role.delete');
            });

            // User management routes
            Route::middleware(['auth:admin'])->prefix('users')->group(function () {
                Route::get('/view', [UserController::class, 'UserView'])->name('admin.user.view');
                Route::get('/add', [UserController::class, 'UserAdd'])->name('admin.user.add');
                Route::post('/store', [UserController::class, 'UserStore'])->name('admin.user.store');
                Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('admin.user.edit');
                Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('admin.user.update');
                Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('admin.user.delete');
            });

            // Profile management routes
            Route::middleware('auth:admin')->prefix('profiles')->group(function () {
                Route::get('/view', [ProfileController::class, 'ProfileView'])->name('admin.profile.view');
                Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('admin.profile.edit');
                Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('admin.profile.store');
                Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('admin.password.view');
                Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('admin.password.update');
            });

            // Category management routes
            Route::middleware('auth:admin')->prefix('category')->group(function () {
                Route::get('/view', [CategoryController::class, 'CategoryView'])->name('admin.category.view');
                Route::get('/add', [CategoryController::class, 'CategoryAdd'])->name('admin.category.add');
                Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('admin.category.store');
                Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('admin.category.edit');
                Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('admin.category.update');
                Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('admin.category.delete');
            });

            // Tag management routes
            Route::middleware('auth:admin')->prefix('tags')->group(function () {
                Route::get('/view', [TagController::class, 'TagView'])->name('admin.tag.view');
                Route::get('/add', [TagController::class, 'TagAdd'])->name('admin.tag.add');
                Route::post('/store', [TagController::class, 'TagStore'])->name('admin.tag.store');
                Route::get('/edit/{id}', [TagController::class, 'TagEdit'])->name('admin.tag.edit');
                Route::post('/update/{id}', [TagController::class, 'TagUpdate'])->name('admin.tag.update');
                Route::get('/delete/{id}', [TagController::class, 'TagDelete'])->name('admin.tag.delete');
            });

            // Post management routes
            Route::middleware('auth:admin')->prefix('posts')->group(function () {
                Route::get('/view', [PostController::class, 'PostView'])->name('admin.post.view');
                Route::get('/add', [PostController::class, 'PostAdd'])->name('admin.post.add');
                Route::get('/update/approver', [PostController::class, 'PostUpdateAprrover'])->name('admin.post.update.approver');
                Route::post('/store', [PostController::class, 'PostStore'])->name('admin.post.store');
                Route::get('/edit/{id}', [PostController::class, 'PostEdit'])->name('admin.post.edit');
                Route::post('/update/{id}', [PostController::class, 'PostUpdate'])->name('admin.post.update');
                Route::get('/delete/{id}', [PostController::class, 'PostDelete'])->name('admin.post.delete');
            });

            // Log Management routes
            Route::middleware('auth:admin')->prefix('logs')->group(function () {
                Route::get('/view', [LogsController::class, 'LogView'])->name('admin.log.view');
            });

            Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');
        });
    }
);
