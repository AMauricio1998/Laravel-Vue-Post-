<?php

use App\Category;
use App\Post;
use App\PostImage;
use Illuminate\Database\Seeder;

class PostImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostImage::truncate();

        $posts = Post::all();

        foreach($posts as $key => $p){
                PostImage::create([
                    'image' => "1617237771.png",
                    'post_id' => $p->id,
                ]);
        }
    }
}
