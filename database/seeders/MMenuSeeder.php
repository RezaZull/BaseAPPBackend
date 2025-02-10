<?php

namespace Database\Seeders;

use App\Models\MMenu;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MMenu::insert([
            [
                'name' => "Master Menu",
                'description' => "Master Menu",
                'obj_type' => '1',
                'created_by' => "DUMMY",
                'created_at' => Carbon::now()
            ],
            [
                'name' => "Master User",
                'description' => "Master User",
                'obj_type' => '1',
                'created_by' => "DUMMY",
                'created_at' => Carbon::now()
            ],
            [
                'name' => "Master Role",
                'description' => "Master Role User",
                'obj_type' => '1',
                'created_by' => "DUMMY",
                'created_at' => Carbon::now()
            ],
            [
                'name' => "Master Role Menu",
                'description' => "Master Role Menu Privilage",
                'obj_type' => '1',
                'created_by' => "DUMMY",
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
