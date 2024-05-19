<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            array(
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin5678'),
                'phone' => '0928817228',
                'avatar' => '',
                'status' => 1,
                'remember_token' => 'mj3uTuIm9frFWZagAAt27eVc7pXI0b2Yox3UgnSdXJzlHO1iJ6rxhMDaDkBD',
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ]);
    }
}
