<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'patrick',
                'email' => 'patrick@api_gateway.service',
                'email_verified_at' => now(),
                'password' => Hash::make('@m!cro_service'),
                'remember_token' => Str::random(10),
            ]
        ]);
        \App\Models\User::factory(10)->create();
    }
}
