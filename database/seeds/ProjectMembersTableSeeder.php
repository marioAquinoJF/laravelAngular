<?php

use Illuminate\Database\Seeder;
use larang\Entities\ProjectMember;

class ProjectMembersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProjectMember::class, 20)->create();
    }

}
