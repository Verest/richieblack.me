<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects')->delete();
        
        \DB::table('projects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'image_id' => 1,
                'slug' => 'simon',
                'description' => 'Simon Game',
                'created_at' => '2019-09-09 00:00:00',
                'updated_at' => '2019-09-09 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'image_id' => 2,
                'slug' => 'markdown-previewer',
                'description' => 'A markdown previewer made in React',
                'created_at' => '2019-09-10 00:00:00',
                'updated_at' => '2019-09-10 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'image_id' => 3,
                'slug' => 'css-zen',
                'description' => 'My CSS styling for <a href="http://www.csszengarden.com/">CSS Zen Garden</a>',
                'created_at' => '2019-09-10 00:00:00',
                'updated_at' => '2019-09-10 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'image_id' => 4,
                'slug' => 'tictactoe',
                'description' => 'Tic Tac Toe made using a canvas element',
                'created_at' => '2019-09-11 00:00:00',
                'updated_at' => '2019-09-11 00:00:00',
            ),
            4 => 
            array (
                'id' => 5,
                'image_id' => 5,
                'slug' => 'wikipedia-viewer',
                'description' => 'Wikipedia search using AJAX request',
                'created_at' => '2019-09-15 08:57:14',
                'updated_at' => '2019-09-15 08:57:14',
            ),
            5 => 
            array (
                'id' => 6,
                'image_id' => 6,
                'slug' => 'stateful-calc',
                'description' => 'A calculator made in React that records history',
                'created_at' => '2019-09-15 08:57:45',
                'updated_at' => '2019-09-15 08:57:45',
            ),
        ));
        
        
    }
}