<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware'=> 'admin'],function(){

    Route::get('post/{id}',[ 'as' => 'home.post' ,'uses' => 'AdminPostsController@post'] );
    Route::resource('admin/users','AdminUsersController');
    Route::resource('admin/posts','AdminPostsController');
    Route::resource('admin/categories','AdminCategoriesController');
    Route::get('admin/media',[ 'as' => 'admin.media.index', 'uses' => 'AdminMediasController@index']);
    Route::get('admin/media/upload',[ 'as' => 'admin.media.upload', 'uses' =>'AdminMediasController@upload']);
    Route::post('admin/media',  'AdminMediasController@store');
    Route::delete('/admin/media/{id}',  'AdminMediasController@destroy');
    Route::delete('/delete/media',  'AdminMediasController@deleteMedia');

    Route::resource('admin/comments','PostCommentsController');
    Route::resource('admin/comment/replies','CommentRepliesController');


});



Route::get('/home', 'HomeController@index');

Route::group(['middleware'=> 'auth'],function(){
    Route::post('comment/reply','CommentRepliesController@createReply');
});

Route::get('/admin',function (){
    return view('admin.index');
});

//Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//});