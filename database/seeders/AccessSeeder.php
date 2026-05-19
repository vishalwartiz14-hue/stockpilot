<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('access')->insert([
            [
                'module_name' => 'users',
                'role'  => '12',
                'add' => '1',
                'edit' => '1',
                'delete' => '1',
                'view' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_name' => 'inventory',
                'role'  => '12',
                'add' => '1',
                'edit' => '1',
                'delete' => '1',
                'view' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_name' => 'suppliers',
                'role'  => '12',
                'add' => '1',
                'edit' => '1',
                'delete' => '1',
                'view' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_name' => 'procurement',
                'role'  => '12',
                'add' => '1',
                'edit' => '1',
                'delete' => '1',
                'view' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_name' => 'recipe_menu_costing',
                'role'  => '12',
                'add' => '1',
                'edit' => '1',
                'delete' => '1',
                'view' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'module_name' => 'waste_management',
                'role'  => '12',
                'add' => '1',
                'edit' => '1',
                'delete' => '1',
                'view' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}