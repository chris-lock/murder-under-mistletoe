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

Auth::routes();

Route::group(array('prefix' => 'admin'), function() {
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::resource('stories', 'Admin\StoryController', ['except' => [
        'index',
    ]]);
    Route::resources([
        'acts' => 'Admin\ActController',
        'characters' => 'Admin\CharacterController',
    ]);
    Route::resource('instructions', 'Admin\InstructionController', ['only' => [
        'store',
        'update',
        'destroy',
    ]]);
    Route::resource('relationships', 'Admin\RelationshipController', ['only' => [
        'store',
        'update',
        'destroy',
    ]]);
});

Route::fallback(function () {
    return view('app');
});
