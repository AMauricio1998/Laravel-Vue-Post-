<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();

        for($i = 1; $i<=20; $i++){
            Tag::create([
                'title' => "Tag $i"
            ]);
        }
    }
}
