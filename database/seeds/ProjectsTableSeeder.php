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
        ));
        
        
    }
}