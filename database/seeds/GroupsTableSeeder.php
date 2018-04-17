<?php

use Illuminate\Database\Seeder;
use App\Professor;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        Group::insert([
            'tutor'     => 'tutor',
            'name'      => '3-WDJ',
        ]);
    }
}
