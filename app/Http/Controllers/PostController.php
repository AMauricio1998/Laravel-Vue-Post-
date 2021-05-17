<?php

namespace App\Http\Controllers;

use auth;
use App\Post;
use App\Category;
use App\Helpers\CustomUrl;
use App\PostImage;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostPost;

class PostController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'rol.admin']);
    }
    
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')
            ->paginate(5);

        //dd($posts);

        return view('dashboard.post.index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        CustomUrl::HolaMundo();

        $categories = Category::pluck('id', 'title');
        return view("dashboard.post.create", ['post' => new Post(), 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request /*StorePostPost*/ $request)
    {

        // $request->validate([
        //     'title' => 'required|min:5|max:500',
        //     //'url_clean' => 'required|min:5|max:500',
        //     'content' => 'required|min:5',
        // ]);
        if($request->url_clean == ""){
            $urlClean = $this->urlTitle($this->convertAccentedCharacters($request->title),'-', true);
        }else{
            $urlClean = $request->url_clean;
        }
        
        echo "Hola mundo: ".$urlClean;
        
        // Post::create($request->validated());

        //echo "Hola mundo: ".request("title");

        // return back()->with('status', 'Post creado con exito!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
     public function show(Post $post)
     {
        //  $post = Post::findOrFail($post);

             return view("dashboard.post.show", ["post" => $post]);
     }

     public static function convertAccentedCharacters($str)
    {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }

    private static function urlTitle($str, $separator = '-', $lowercase = false) {
    if ($separator === 'dash') {
        $separator = '-';
    } elseif ($separator === 'underscore') {
        $separator = '_';
    }

    $q_separator = preg_quote($separator, '#');

    $trans = array(
        '&.+?;' => '',
        '[^\w\d _-]' => '',
        '\s+' => $separator,
        '(' . $q_separator . ')+' => $separator,
    );

    $str = strip_tags($str);
    foreach ($trans as $key => $val) {
        $str = preg_replace('#' . $key . '#iu', $val, $str);
    }

    if ($lowercase === true) {
        $str = strtolower($str);
    }

    return trim(trim($str, $separator));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
     public function edit(Post $post)
     {
        $categories = Category::pluck('id', 'title');
        return view("dashboard.post.edit", ['post' => $post, 'categories' => $categories]);      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
     public function update(StorePostPost $request, Post $post)
     {        
        $post->update($request->validated());

        return back()->with('status', 'Post actualizado con exito!');
     }

     public function image(Request $request, Post $post)
     {        
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,bmp|max:10240', //10Mb
        ]);

        $filename = time() . "." . $request->image->extension();

        $request->image->move(public_path('images'), $filename);

        PostImage::create([ 'image' => $filename, 'post_id'=> $post->id]);
        return back()->with('status', 'Imagen cargada con exito!');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
     public function destroy(Post $post)
     {
         $post->delete();
         return back()->with('status', 'Post borrado con exito!');
     }
}
