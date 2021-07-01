<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// DB::listen(function ($query) {
//     echo "<code>".$query->sql."<code>";
//     echo "<code>".$query->time."<code>";
//     // $query->bindings
// });
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('post', 'api\PostController')->only(['index', 'show']);//solo index y show son accesibles para la API

Route::get('post/{category}/category', 'api\PostController@category');
Route::get('post/{url_clean}/url_clean', 'api\PostController@url_clean');

Route::get('category', 'api\CategoryController@index');//listado de categorias
Route::get('category/all', 'api\CategoryController@all');//listado de todas las categorias

