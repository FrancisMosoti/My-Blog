<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\commentsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\passwordController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginController::class)->group(function () {
    // Your routes here
    Route::get('/login', 'view')->name('login');
    Route::post('/login', 'login')->name('login');
});


Route::middleware(['DetectForbiddenWords', 'auth', 'detectSpam'])->group(function (){
    Route::post('/AddPost/{user}',[PostController::class, 'store'])->name('add');
    Route::get('/AddPost/{user}',[PostController::class, 'add'])->name('add');
    
});

Route::controller(RegisterController::class)->group(function () {
    // Your routes here
    Route::get('/register', 'view');
    Route::post('/register', 'store')->name('register');
});




Route::middleware(['auth'])->group(function (){
    Route::post('/AddPost/{user}',[PostController::class, 'store'])->name('add');
    Route::get('/AddPost/{user}',[PostController::class, 'add'])->name('add');
    
    Route::get('/post/{post}',[PostController::class, 'show'])->name('show');

    Route::post('/Comments/{post}',[commentsController::class, 'store'])->name('comment');
    Route::delete('/Comments/delete/{id}',[commentsController::class, 'destroy'])->name('comment.delete');


    Route::get('/home',[HomeController::class, 'index'])->name('back');


    Route::get('/profile/{user}',[HomeController::class, 'profile'])->name('profile');
    Route::post('/profile/{user}',[ImageController::class, 'update'])->name('profile');

    
    Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('posts.destroy');



    // file upload for user
    

});


// logout route
Route::post('/logout',[LogoutController::class, 'logout'])->name('logout');
Route::get('/logout',[LogoutController::class, 'logout']);


// reset password
Route::middleware(['guest'])->group(function (){
    Route::get('/forgot-password', [PasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password', [PasswordController::class, 'forgot'])->name('password.forgot');
    Route::get('/reset-password/{token}',[PasswordController::class, 'reset'] )->name('password.reset');
});

    // admin register
    Route::get('/admin/register',[AdminController::class, 'register'])->name('admin.register');
    Route::post('/admin/register',[AdminController::class, 'store']);
    Route::get('/admin/login',[AdminController::class, 'login'])->name('admin.login');





    // Other admin-only routes

    // comments
    Route::get('/admin/comments',[AdminController::class, 'comment'])->name('admin.comments');
    Route::delete('/comment/delete/{id}', [commentsController::class, 'destroy'])->name('comments.destroy');
    
    // admin
    

    Route::get('/admin/posts',[AdminController::class, 'posts'])->name('admin.posts');
    Route::post('/admin',[CategoriesController::class, 'store'])->name('categories');
    Route::delete('/categories/delete/{id}',[CategoriesController::class, 'destroy'])->name('categories.destroy');
 


    Route::middleware(['auth'])->prefix('admin')->group(function () {

        Route::get('/admin/dash',[AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/side',[AdminController::class, 'side'])->name('admin.side');
        Route::delete('/user/delete/{id}', [AdminController::class, 'destroy'])->name('user.destroy');
    });