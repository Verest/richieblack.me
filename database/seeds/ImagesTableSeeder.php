<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('images')->delete();
        
        \DB::table('images')->insert(array (
            0 => 
            array (
                'id' => 1,
                'src' => 'simon.png',
                'alt' => 'The Simon Game',
                'created_at' => '2019-09-09 00:00:00',
                'updated_at' => '2019-09-09 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'src' => 'markdown.png',
                'alt' => 'Markdown Previewer Made in React',
                'created_at' => '2019-09-10 00:00:00',
                'updated_at' => '2019-09-10 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'src' => 'css-zen.png',
                'alt' => 'CSS Zen Submission',
                'created_at' => '2019-09-10 00:00:00',
                'updated_at' => '2019-09-10 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'src' => 'tictactoe.png',
                'alt' => 'Tic Tac Toe Game',
                'created_at' => '2019-09-11 00:00:00',
                'updated_at' => '2019-09-11 00:00:00',
            ),
            4 => 
            array (
                'id' => 5,
                'src' => 'wiki-view.png',
                'alt' => 'Wikipedia Viewer',
                'created_at' => '2019-09-15 00:00:00',
                'updated_at' => '2019-09-15 00:00:00',
            ),
            5 => 
            array (
                'id' => 6,
                'src' => 'state-calc.png',
                'alt' => 'Calculator Made With React',
                'created_at' => '2019-09-15 00:00:00',
                'updated_at' => '2019-09-15 00:00:00',
            ),
        ));
        
        
    }
}