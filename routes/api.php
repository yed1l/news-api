<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('categories','CategoryController@index')->middleware('auth:api');
Route::post('category/store','CategoryController@store')->middleware('auth:api');
Route::get('category/{keyword}/search','CategoryController@searchCategory');

Route::get('articles','ArticleController@index')->middleware('auth:api');
Route::post('article/store','ArticleController@store')->middleware('auth:api');
Route::get('article/{id}/show','ArticleController@show');
Route::get('article/{keyword}/search','ArticleController@searchArticle');

Route::get('authors','AuthorController@index')->middleware('auth:api');
Route::post('register','AuthorController@register');
Route::post('login','AuthorController@login');
Route::post('logout','AuthorController@logout')->middleware('auth:api');

Route::get('author/{id}/articles','AuthorController@show')->middleware('auth:api');
Route::get('category/{id}/articles','CategoryController@show')->middleware('auth:api');
