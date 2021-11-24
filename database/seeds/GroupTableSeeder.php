<?php

use Illuminate\Database\Seeder;

use App\Models\Info\InfoBase;

use App\Models\Group\Group;
use App\Models\Group\GroupType;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupType::setUp();
    }
}
