<?php

use App\Post;
use App\PostComment;
use Illuminate\Database\Seeder;

class PostCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostComment::truncate();

        $posts = Post::all()->where("id", "<=", 15);

        foreach($posts as $key => $post){
            for($i = 1; $i <=($key+1); $i++){
                PostComment::create([
                    'title' => "Este es el titulo del contenido $post->title",
                    'message' => "Este es el cuerpo del comentario",
                    'user_id'  => 4,
                    'post_id'  => $post->id,
                ]);
            }
        }
    }
}
