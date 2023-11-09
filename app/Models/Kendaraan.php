<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';
    protected $guarded =['id'];

    public function getRouteKeyName()
    {
        return 'nama';
    }

    public function parkir(){
        return $this->hasMany(Parkir::class);
    }

    
}
