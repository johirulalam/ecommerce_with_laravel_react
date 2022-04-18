<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        User::create([
            'name' => 'zahidul islam',
            'email' => 'zahid@gmail.com',
            'password' => Hash::make('zahid@gmail.com'),
            'admin' => 1,
            'ip' => '118.179.18.39',
            'email_verified_at' => now()
        ]);
    }
}
