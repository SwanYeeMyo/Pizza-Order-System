<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\UserController;
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
// login//register
Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('/loginPage', [AuthController::class, 'loginPage'])->name(
        'auth#loginPage'
    );
    Route::get('/registerPage', [AuthController::class, 'RegisterPage'])->name(
        'auth#register'
    );

});

Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name(
        'dashboard'
    );
    Route::middleware(['admin_auth'])->group(function () {
        // category
        Route::prefix('category')->group(function () {
            Route::get('list', [CategoryController::class, 'list'])->name(
                'category#list'
            );
            Route::get('create/page', [
                CategoryController::class,
                'createPage',
            ])->name('category#createPage');

            Route::post('category/create', [
                CategoryController::class,
                'create',
            ])->name('category#create');

            Route::get('delete/{id}', [
                CategoryController::class,
                'delete',
            ])->name('category#delete');

            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');

            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        }
        );
        //admin
        Route::prefix('admin')->group(function () {
            //password
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('chagne/password', [AdminController::class, 'changePassword'])->name('admin#changePassword');
            //profile
            Route::get('details', [AdminController::class, 'detail'])->name('admin#details');
            Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('roleChangePage/{id}', [AdminController::class, 'chagneRolePage'])->name('admin#roleChangePage');
            Route::post('roleChange/{id}', [AdminController::class, 'chagneRole'])->name('admin#roleChange');
            Route::get('ajax/change', [AdminController::class, 'ajaxChangeRole'])->name('admin#ajaxRoleChange');
            Route::get('getContactList', [ContactController::class, 'list'])->name('contact#list');

        });
        //products
        Route::prefix('products')->group(function () {
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('createPage', [ProductController::class, 'createPage'])->name('product#creatPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('detail/{id}', [ProductController::class, 'detail'])->name('product#detail');
            Route::get('updatePage/{id}', [ProductController::class, 'updatePage'])->name('product#updatePage');
            Route::post('update', [ProductController::class, 'update'])->name('product#update');
        });
        // orders
        Route::prefix('orders')->group(function () {
            Route::get('list', [OrderController::class, 'list'])->name('admin#order');
            Route::get('change/status', [OrderController::class, 'changeStatus'])->name('admin#changeStatus');
            Route::get('ajax/change/status', [OrderController::class, 'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('listInfo/{orderCode}', [OrderController::class, 'listInfo'])->name('admin#listInfo');
        });
    });

    //user home
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::redirect('/', '/homePage');
        Route::get('/homePage', [UserController::class, 'home'])->name('user#home');
        Route::get('cart', [UserController::class, 'cart'])->name('user#cart');
        Route::get('filter/{id}', [UserController::class, 'filter'])->name('user#Filter');
        Route::post('content', [UserController::class, 'contentForm'])->name('user#contentForm');

        Route::prefix('pizza')->group(function () {
            Route::get('detail/{id}', [UserController::class, 'pizzaDetail'])->name('user#pizzaDetail');
        });

        Route::get('changepwPage', [UserController::class, 'pwChangePage'])->name('user#pwChangePage');
        Route::post('changePassword', [UserController::class, 'pwChange'])->name('user#pwChange');
        Route::get('changeAccountPage', [UserController::class, 'profileChange'])->name('user#profileChange');
        Route::post('changeAccount', [UserController::class, 'change'])->name('user#change');

        Route::prefix('ajax')->group(function () {
            Route::get('pizzaList', [AjaxController::class, 'pizzaList'])->name('ajax#lists');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#cart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clear/cart', [AjaxController::class, 'clear'])->name('ajax#clear');
            Route::get('remove', [AjaxController::class, 'remove'])->name('ajax#remove');
            Route::get('view', [AjaxController::class, 'viewCount'])->name('ajax#viewCount');

        });
        // history
        Route::get('history', [UserController::class, 'order'])->name('user#order');

    });

});

//admin
