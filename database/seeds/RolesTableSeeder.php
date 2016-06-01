<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createdAt = Carbon::now();
        $roles = [
            [
                'id' => 1,
                'name' => \Config::get('role.SUPERADMIN'),
                'description' => 'Super Admin',
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ]
        ];
        DB::table('roles')->insert($roles);
    }
}
