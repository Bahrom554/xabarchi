<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'Filemanager', 'prefix' => 'admin/filemanager'], function () {
        Route::get('/', 'FilemanagerController@index');
        Route::delete('/{id}', 'FilemanagerController@delete');
        Route::post('/uploads', 'FilemanagerController@uploads')->name('image.upload');
    });
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('/post', 'PostController');
        Route::put('post/{post}/publish', 'PostController@publish')->name('post.publish');
        Route::resource('tag', 'TagController');
        Route::resource('category', 'CategoryController');
        Route::get('message', 'MessageController@index')->name('message.index');
        Route::get('message/{message}', 'MessageController@show')->name('message.show');
        Route::delete('message/{message}', 'MessageController@destroy')->name('message.destroy');
        Route::get('posts/search','PostController@search')->name('post.search');
        Route::get('categories/search','CategoryController@search')->name('category.search');
        Route::get('tags/search','TagController@search')->name('tag.search');
        // Route::resource('user','UserController');
    });
});
Route::post('message', 'Admin\MessageController@store')->name('message.store');
Route::group(['namespace' => 'User'], function () {
    Route::post('post/{post}/comments', 'CommentController@store')->name('post.comment');
    Route::get('/', 'PostController@index')->name('upost.index');
    Route::get('post/{post}', 'PostController@show')->name('upost.show');
    Route::get('search', 'PostController@search')->name('search');
    Route::get('post/category/{category}', 'PostController@category')->name('post.category');
    Route::get('post/tag/{tag}', 'PostController@tag')->name('post.tag');
    Route::get('today', 'PostController@today')->name('today');
    Route::get('about', function () {return view('user.about');})->name('about');
    Route::get('contact', function () {return view('user.contact');})->name('contact');
});
Auth::routes();
