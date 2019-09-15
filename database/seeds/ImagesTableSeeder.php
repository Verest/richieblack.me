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
        ));
        
        
    }
}