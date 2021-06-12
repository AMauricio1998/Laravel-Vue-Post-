<?php

namespace App\Http\Controllers;

use App\Post;
use auth;
use App\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PostCommentController extends Controller{

    public function __construct()
    {
        $this->middleware(['auth', 'rol.admin']);
    }
    
    public function index()
    {
        $postComments = PostComment::orderBy('created_at','desc')
            ->paginate(10);

        return view('dashboard.post-comment.index',['postComments' => $postComments]);
    }

    public function post(Post $post)
    {

        $posts = Post::all();

        $postComments = PostComment
            ::orderBy('created_at','desc')
            ->where('post_id','=',$post->id)
            ->paginate(10);

        return view('dashboard.post-comment.post',
        ['postComments' => $postComments,
        'posts' => $posts,
        'post' => $post]);
    }

    
     public function show(PostComment $postComment)
     {
        //  $postComment = PostComment::findOrFail($postComment);

             return view("dashboard.post-comment.show", ["postComment" => $postComment]);
     }

     public function jshow(PostComment $postComment)
     {
        //  $postComment = PostComment::findOrFail($postComment);

            return response()->json($postComment);
            //instruccion para devolver una vista a un modal
            //return view("dashboard.post-comment.show", ["postComment" => $postComment]);

     }

     public function proccess(PostComment $postComment)
     {
        if($postComment->approved == '0'){
            $postComment->approved = '1';
        }else{
            $postComment->approved = '0';
        }
        $postComment->save();

            return response()->json($postComment->approved);

     }


     public function destroy(PostComment $postComment)
     {
         $postComment->delete();
         return back()->with('status', 'Comentario eliminado con exito!');
     }
}
