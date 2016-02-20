<?php

use Illuminate\Database\Seeder;
use larang\Entities\Project;

class ProjectTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Project::class, 30)->create();
    }

}
