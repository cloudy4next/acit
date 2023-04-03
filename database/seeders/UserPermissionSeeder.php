<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $permissions = [
            ['name' => 'Farmer'],
            ['name' => 'Farmer add'],
            ['name' => 'Farmer delete'],
            ['name' => 'Diagnosis'],
            ['name' => 'Diagnosis reply'],
            ['name' => 'Post'],
            ['name' => 'Post store'],
            ['name' => 'Post edit'],
            ['name' => 'Post delete'],
            ['name' => 'Tutorial'],
            ['name' => 'Tutorial store'],
            ['name' => 'Tutorial edit'],
            ['name' => 'Tutorial delete'],
            ['name' => 'Market'],
            ['name' => 'Market edit'],
            ['name' => 'Market delete'],
            ['name' => 'Market store'],
            ['name' => 'Notice'],
            ['name' => 'Notice store'],
            ['name' => 'Notice edit'],
            ['name' => 'Notice delete'],
            ['name' => 'StakeHolder'],
            ['name' => 'StakeHolder store'],
            ['name' => 'StakeHolder edit'],
            ['name' => 'StakeHolder delete'],
            ['name' => 'Settings'],

        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                [
                    'name' => $permission['name'],
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
        }
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123'),
        ]);

        Role::create(["name" => "Super admin"])->givePermissionTo(Permission::all());
        $user->assignRole('Super admin');
    }
}
