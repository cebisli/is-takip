<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            'name' =>"İkram Çebişli",
            'email' => "ikram@hotmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$JJrUBIp7b3k9stPpkTJ6.egFIeZxAXdJc4evZQhNXe.1nam2seyt.', // 123456789
            'pass_1' => '123456789',
            'remember_token' => Str::random(10),
            'type' => 'admin',
        ]);

         \App\Models\User::factory(1)->create();
    }
}
