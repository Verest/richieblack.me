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
        ));
        
        
    }
}