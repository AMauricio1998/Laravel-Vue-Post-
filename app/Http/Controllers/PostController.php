<?php

namespace App\Http\Controllers;

use auth;
use App\Post;
use App\Category;
use App\Helpers\CustomUrl;
use App\PostImage;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostPost;
use App\Http\Requests\UpdatePostPut;
use App\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

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

         $personas = [
             ["nombre" => "Mauricio 0", "edad" => 50],
             ["nombre" => "Mauricio 1", "edad" => 70],
             ["nombre" => "Mauricio 2", "edad" => 15],
         ];
        // dd($personas);

         $collection1 = collect($personas);
        // dd($collection1);
         $collection2 = new Collection($personas);
        // dd($collection2);
         $collection3 = Collection::make($personas);
        // dd($collection3);

        // dd($collection2->filter(function($value, $key){
        //     return $value['edad'] > 17;
        // })
        // ->sum('edad'));

        $personas = ["nombre 1", "nombre 2", "nombre 3", "nombre 4", "nombre 1"];

        $collection = collect($personas);
        //dd((bool) $collection->intersect(['nombre 1'])->count());

        $posts = Post::orderBy('created_at','desc')
            ->paginate(10);

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
        $tags = Tag::pluck('id', 'title');
        $categories = Category::pluck('id', 'title');
        $post = new Post();
        return view("dashboard.post.create", compact('post', 'categories', 'tags' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostPost $request)
    {
     
        // $request->validate([
        //     'title' => 'required|min:5|max:500',
        //     //'url_clean' => 'required|min:5|max:500',
        //     'content' => 'required|min:5',
        // ]);
        //condicion para crear la url por titulo o url_clean
        if($request->url_clean == ""){
            $urlClean = CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->title),'-', true);
        }else{
            $urlClean = CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->url_clean),'-', true);
        }
        $requestData = $request->validated();
        
        $requestData['url_clean'] = $urlClean;

        $validator = Validator::make($requestData, StorePostPost::myRules());

        if ($validator->fails()) {
            return redirect('dashboard/post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        //dd($requestData);
        $post = Post::create($requestData);
        
        $post->tags()->sync($request->tags_id);

        return back()->with('status', 'Post creado con exito!');

    }

  
     public function show(Post $post)
     {
        //  $post = Post::findOrFail($post);

             return view("dashboard.post.show", ["post" => $post]);
     }


     public function edit(Post $post)
     {
        // dd($post->tags);
        $tag = Tag::find(1);
        // dd($tag->posts);

        $tags = Tag::pluck('id', 'title');

        $categories = Category::pluck('id', 'title');
        return view("dashboard.post.edit",compact('post', 'categories', 'tags' ));      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
     public function update(UpdatePostPut $request, Post $post)
     {        

        //dd($request->tags_id);

        // $post->tags()->attach(1);
        $post->tags()->sync($request->tags_id);

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


//----------imagen desde ckeditor----------------------------------------
     public function contentImage(Request $request)
     {        
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,bmp|max:10240', //10Mb
        ]);

        $filename = time() . "." . $request->image->extension();

        $request->image->move(public_path('images_post'), $filename);

        return response()->json(["default" => URL::to('/') . '/images_post/' . $filename]);

     }
//-----------------------------------------------------------------

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
