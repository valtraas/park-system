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
            'nama'=>'Algorithm',
            'username'=>'Algo',
            'Password'=>Hash::make('algo02'),
            'role_id'=>1
        ]);
        User::create([
            'nama'=>'Neptune',
            'username'=>'Nepts',
            'Password'=>Hash::make('neptune02'),
            'role_id'=>2
        ]);
        User::create([
            'nama'=>'Lostvayne',
            'username'=>'Lost',
            'Password'=>'lost02',
            'role_id'=>3
        ]);
    }
}
