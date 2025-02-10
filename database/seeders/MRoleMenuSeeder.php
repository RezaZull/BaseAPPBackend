<?php

namespace Database\Seeders;

use App\Models\MMenu;
use App\Models\MRole;
use App\Models\MRoleMenu;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MRoleMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = MMenu::get();
        $role = MRole::get();

        $dataInsert = [];
        foreach ($role as $roleData) {
            foreach ($menu as $menuData) {
                $dataPush = [
                    'id_m_roles' => $roleData->id,
                    'id_m_menus' => $menuData->id,
                    'flag_create' => false,
                    'flag_read' => false,
                    'flag_update' => false,
                    'flag_delete' => false,
                    'flag_export' => false,
                    'flag_import' => false,
                    'created_by' => 'DUMMY',
                    'obj_type' => '3',
                    'created_at' => Carbon::now()
                ];
                $dataInsert[] = $dataPush;
            }
        }

        MRoleMenu::insert($dataInsert);
    }
}
