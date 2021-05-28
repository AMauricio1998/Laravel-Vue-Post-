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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

 Route::get('/', function () {
     return view('welcome');
 })->name('home');

// //--------Ruta basica solo texto----------------------
// Route::get('/test', function () {
//     return('Hola mundo');
// });

// //--------Ruta basica con parametro----------------------
// Route::get('/hola/{nombre?}', function ($nombre = "Alan") {
// // El route es un helper en el que se puede concatenr las rutas con nombre sin definir el token de la ruta a la que se 
// //  requiere conectar
//     return "Hola $nombre conocenos: <a href='".route("nosotros")."'>nosotros<a>";
// });

// // --------Rutas con nombres----------------------
// Route::get('/sobre-nosotros-los-borrachos', function () {
//     return "<h1> Toda la informacion sobre nosotros <h1>";
// })->name("nosotros");

// // --------Rutas para vista con envio de variables el with permite avilitar las variables que se 
// // encuentran en la vista--------------------
// Route::get('home/{nombre?}/{apellido?}', function ($nombre = "Juancho", $apellido = "Reyes") {

//     $posts = ["Posts1","Posts2","Posts3","Posts4"];
//     $posts2 = [];

//     // return view("home")->with("nombre", $nombre)->with("apellido", $apellido);   
//     return view("home", ['nombre' => $nombre, 'apellido' => $apellido, 'posts' => $posts, 'posts2' => $posts2]);
// })->name("home");


Route::get('/', 'web\webController@index')->name('index');
Route::get('/categories', 'web\webController@index')->name('index');
//resolver ruta lado del cliente vue
Route::get('/detail/{id}', 'web\webController@detail')->name('detail');
Route::get('/post-category/{id}', 'web\webController@post_category');
Route::get('/contact', 'web\webController@contact');


Route::resource('dashboard/post', 'PostController');
Route::resource('dashboard/contact', 'ContactController')->only([
    'index', 'show', 'destroy',
]);

Route::resource('dashboard/post-comment', 'PostCommentController')->only([
    'index', 'show', 'destroy',
]);

Route::get('dashboard/post-comment/{post}/post', 'PostCommentController@post')->name('post-comment.post');


Route::post('dashboard/post/{post}/image', 'PostController@image')->name('post.image');
//ruta imagen ckeditor-------------------------------------------
Route::post('dashboard/post/content_image', 'PostController@contentImage');
//----------------------------------------------------------------
Route::resource('dashboard/category', 'CategoryController');
Route::resource('dashboard/user', 'UserController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
