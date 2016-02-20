<?php

use Illuminate\Database\Seeder;
use larang\Entities\ProjectFile;

class ProjectFileTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        //  Project::truncate();
        factory(ProjectFile::class, 30)->create();
    }

}
