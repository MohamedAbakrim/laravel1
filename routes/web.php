<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return redirect()->route('blog.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'doLogin']);


Route::prefix('/blog')->name('blog.')->controller(PostController::class)->group(function(){

    Route::get('/', 'index')->name('index');
    

    Route::get('/{post}/edit', 'edit')->name('edit')->middleware('auth');
    Route::patch('/{post}/edit', 'update')->middleware('auth');
    
    Route::get('/{title}/{post}', 'show')->name('show');


    Route::get('/new', 'create')->name('create')->middleware('auth');
    Route::post('/new', 'store')->middleware('auth');

});