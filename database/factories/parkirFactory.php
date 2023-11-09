<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Parkir;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\parkir>
 */
class parkirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
     public function definition():array
     {
         $nomor_polisi = $this->faker->sentence(mt_rand(3, 8));
     
         return[
             'nomor_polisi' => $nomor_polisi,
             'slug' => Str::slug($nomor_polisi),
             'jam_masuk' => now(),
             'tanggal_masuk' => now(),
             'kendaraan_id' => $this->faker->numberBetween(1, 3),
             'user_id' => 2,
             'harga' => 2000.00,
             'status' => 'Masuk'
         ];
     }
     
     
}
