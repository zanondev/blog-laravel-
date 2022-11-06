<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Site\SiteBlogController;
use App\Http\Controllers\Site\DetailsController;
//use App\Http\Controllers\Site\HomeController;

Route::get('/', [SiteBlogController::class, 'index'])->name('site.blog_list');
Route::get('/detail/{url}', [DetailsController::class, 'details'])->name('site.blog_detail');
Route::get('/categoria/{category_url}', [SiteBlogController::class, 'index'])->name('site.blog_list_category');
Route::get('/busca/{search?}', [SiteBlogController::class, 'search'])->name('site.blog_search');


use App\Http\Controllers\Admin\LoginAdmin;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostGalleryController;


Route::namespace("Admin")
    ->group(function () {
        Route::prefix('admin')->group(function () {
            Route::any('/', [LoginAdmin::class, 'index'])->name('login.page');
        });
        Route::any('/loginAdmin', [LoginAdmin::class, 'login'])->name("admin.login");
        Route::any('/logoutAdmin', [LoginAdmin::class, 'logout'])->name("admin.logout");
        Route::middleware('auth.user')->group(function () { //verifica se tem usuario logado, se direciona pro login
            Route::prefix('admin')->group(function () {
                Route::any('/dashboard', [Dashboard::class, 'index'])->name("dashboard");
                // Gestores
                Route::any('/lista-gestores', [AdminController::class, 'index'])->name("admin.list");
                Route::any('/adicionar-gestor', [AdminController::class, 'create'])->name("admin.add");
                Route::any('/editar-gestor/{id}', [AdminController::class, 'edit'])->name("admin.edit");

                // PostCategory
                Route::any('/lista-categoria-post', [PostCategoryController::class, 'index'])->name("post_category.list");
                Route::any('/adicionar-categoria-post', [PostCategoryController::class, 'create'])->name("post_category.add");
                Route::any('/editar-categoria-post/{id}', [PostCategoryController::class, 'edit'])->name("post_category.edit");

                //Post
                Route::any('/lista-posts', [PostController::class, 'index'])->name("post.list");
                Route::any('/adicionar-post', [PostController::class, 'create'])->name("post.add");
                Route::any('/editar-post/{id}', [PostController::class, 'edit'])->name("post.edit");

                // PostGallery
                Route::any('/editar-galeria/{post_id}', [PostGalleryController::class, 'index'])->name("post_gallery.edit");
            });

            // Gestores
            Route::any('/addAdmin', [AdminController::class, 'store'])->name("admin.store");
            Route::any('/changeAdmin', [AdminController::class, 'update'])->name("admin.update");
            Route::any('/deleteAdmin', [AdminController::class, 'updateStatus'])->name("admin.delete");
            Route::any('/deleteMultipleAdmin', [AdminController::class, 'updateMultipleStatus'])->name("admin.delete_multiple");

            // PostCategory
            Route::any('/addPostCategory', [PostCategoryController::class, 'store'])->name("post_category.store");
            Route::any('/changePostCategory', [PostCategoryController::class, 'update'])->name("post_category.update");
            Route::any('/deletePostCategory', [PostCategoryController::class, 'updateStatus'])->name("post_category.delete");
            Route::any('/deleteMultiplePostCategory', [PostCategoryController::class, 'updateMultipleStatus'])->name("post_category.delete_multiple");

            // Post
            Route::any('/addPost', [PostController::class, 'store'])->name("post.store");
            Route::any('/changePost', [PostController::class, 'update'])->name("post.update");
            Route::any('/deletePost', [PostController::class, 'updateStatus'])->name("post.delete");
            Route::any('/deleteMultiplePost', [PostController::class, 'updateMultipleStatus'])->name("post.delete_multiple");

            // PostGallery
            Route::any('/addPostGallery', [PostGalleryController::class, 'createMultipleImages'])->name('post_gallery.store');
            Route::any('/updatePostGallery', [PostGalleryController::class, 'updateGalleryImageAlt'])->name('post_gallery.update');
            Route::any('/deletePostGallery', [PostGalleryController::class, 'updateStatus'])->name('post_gallery.delete');
        });
    });
