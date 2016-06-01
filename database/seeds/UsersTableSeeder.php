<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createdAt = Carbon::now();
        $user = [
            [
                'id' => 1,
                'name' => 'Super Admin'
                'email' => 'superadmin@domain.com',
                'password' => bcrypt('password'),
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ],
        ];
        DB::table('users')->insert($user);
        DB::table('role_user')->insert(['role_id' => 1, 'user_id' => 1]);
    }
}
