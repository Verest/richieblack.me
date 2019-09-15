<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'test',
                'title' => 'Test Post',
                'meta' => 'This is a test post meta.',
                'body' => '##This is a test markdown post. 

I am currently creating a simple blog platform that stores posts in markdown format.',
                'created_at' => '2019-09-15 00:00:00',
                'updated_at' => '2019-09-15 00:00:00',
            ),
        ));
        
        
    }
}