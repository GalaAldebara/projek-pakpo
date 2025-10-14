<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Pakpo Yulius',
            'username' => 'pakpo', // sesuai field di migration
            'email' => 'pakpo@gmail.com',
            'password' => Hash::make('pakpo123'), // ubah sesuai kebutuhan
            'is_admin' => true,
        ]);
    }
}
