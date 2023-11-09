<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Parkir;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            KendaraanSeeder::class
        ]);

        $role = [
            'Admin',
            'Operator Masuk',
            'Operator Keluar'
        ];

        for ($i=0; $i < count($role) ; $i++) { 
            Role::create([
                'nama'=>$role[$i]
            ]);
        }

        Parkir::factory(5)->create();

        
        
    }
}
