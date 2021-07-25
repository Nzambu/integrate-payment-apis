<?php

namespace Database\Seeders;

use App\Models\Profiles\Email;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        Email::create([
            'email' => 'patricknzambu@gmail.com',
            'user_id' => 1,
            'primary' => true
        ]);

    }
}
