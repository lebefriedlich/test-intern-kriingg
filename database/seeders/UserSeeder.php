<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Maulana',
            'username' => 'lana123',
            'password' => Hash::make('123456'),
            'id_role' => 1,
        ]);

        User::create([
            'nama' => 'Haekal',
            'username' => 'haekal123',
            'password' => Hash::make('123456'),
            'id_role' => 1,
        ]);

        User::create([
            'nama' => 'Noval',
            'username' => 'noval123',
            'password' => Hash::make('123456'),
            'id_role' => 2,
        ]);

        User::create([
            'nama' => 'Akbar',
            'username' => 'akbar123',
            'password' => Hash::make('123456'),
            'id_role' => 3,
        ]);
    }
}
