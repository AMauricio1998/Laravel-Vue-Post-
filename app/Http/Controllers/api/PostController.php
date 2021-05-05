<?php

namespace App\Http\Controllers\api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class PostController extends ApiResponseController
{
    public function index() {
        //obtenemos todos los registros de nuestro modelo post, paginados
        $posts = Post::
        //Referenciar datos de la tabla imagen por el post_id para referenciar con el id de tabla post
        join('post_images', 'post_images.post_id', '=', 'posts.id')->
        join('categories', 'categories.id', '=', 'posts.category_id')->
        //seleccionamos todos los datos de la tabla post, como la tabla post y categories tienen title repetido
        //retornamos el title de la tabla categories con un alias y por ultimo selecciona la imagen del post
        select('posts.*', 'categories.title as category', 'post_images.image')->
        orderBy('posts.created_at','desc')->paginate(2);
        //retornamos la respuesta json de datos del post
        return $this->succesResponse($posts);
    }

    public function show(Post $post) {
        //obtiene los datos de la imagen, ejecuta la relacion que tenemos en el modelo
        $post->image;
        $post->category;
        return $this->succesResponse($post);
         //obtenemos todos los registros de nuestro modelo post, paginados, para poder mostrarlos
         //retornamos la respuesta json de datos del post
         //return response()->json(array("data" => $post, "code" => 500, "msj" => ''), 500);
    }

    public function url_clean(String $url_clean) {
        $post = Post::where('url_clean', $url_clean)->FirstOrFail();
        $post->image;
        $post->category;
        return $this->succesResponse($post);
        }


    public function category(Category $category) {
       // dd($category->post()); agregar el paginate a los metodos eloquent
       //retornamos un listado de post y el nombre de su categoria
        return $this->succesResponse(["posts"=>$category->post()->paginate(10), "category" => $category]);
    }
    
}
