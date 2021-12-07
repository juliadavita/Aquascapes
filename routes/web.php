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

//Return resources as homepage
Route::resource('/', 'App\Http\Controllers\PostsController');

Route::get('/welcome', function () {
    return view('welcome');
});

// Controller
Route::resource('posts', 'App\Http\Controllers\PostsController');







// OLD CODE

//Route::get('/', function () {
//    return view('posts');
//});

//Route::get('/posts/{post}', function ($slug) {
//    $post = file_get_contents(__DIR__ .  "/../resources/posts/{$slug}.html");
//
//    return view('post', [
//        'post' => $post
//    ]);
//});
