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




Route::get('/register',[RegisterController::class, 'view']);
Route::post('/register',[RegisterController::class, 'store'])->name('register');



Route::get('/login',[LoginController::class, 'view'])->name('login');
Route::post('/login',[LoginController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function (){
    Route::post('/AddPost/{user}',[PostController::class, 'store'])->name('add');
    Route::get('/AddPost/{user}',[PostController::class, 'add'])->name('add');
    
    Route::get('/post/{post}',[PostController::class, 'show'])->name('show');

    Route::post('/Comments/{post}',[commentsController::class, 'store'])->name('comment');


    Route::get('/home',[HomeController::class, 'index'])->name('back');

    
    Route::post('/home',[CategoriesController::class, 'store'])->name('categories');


    Route::get('/profile/{user}',[HomeController::class, 'profile'])->name('profile');
    Route::post('/profile/{user}',[ImageController::class, 'update'])->name('profile');

    
    Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('posts.destroy');



    // file upload for user

});


// logout route
Route::post('/logout',[LogoutController::class, 'logout'])->name('logout');
Route::get('/logout',[LogoutController::class, 'logout']);




