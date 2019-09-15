<?php

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

Route::get('/', 'MainController@index')->name('home');

Route::group(['prefix' => 'projects'], function() {
    Route::get('/', 'ProjectController@index')->name('projects');
    Route::get('/{project}', 'ProjectController@showProject')->name('project');
});

Route::group(['prefix' => 'blog'], function() {
    Route::get('/', 'BlogController@index')->name('blog');
    Route::get('/{postBySlug}', 'BlogController@showPost')->name('blogPost');
});


