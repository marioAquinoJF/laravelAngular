<?php

use Illuminate\Database\Seeder;
use larang\Entities\ProjectMember;

class ProjectMenbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        factory(ProjectMember::class, 10)->create();
    }
}
