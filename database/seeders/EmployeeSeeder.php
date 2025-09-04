<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Model\User;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Iqbal Makmur',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
        ]);

        \App\Models\Employee::create([
            'user_id'       => $user->id,
            'employee_id' => 'EMP001',
            'name'          => 'Iqbal Makmur',
            'department'    => 'IT',
            'position'      => 'Developer',
        ]);
    }
}
