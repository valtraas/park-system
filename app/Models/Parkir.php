<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    use HasFactory;
    protected $table = 'parkir';
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePark($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function ($query, $search) {
            return $query->where('nomor_polisi', '%' . $search . '%');
        });
    }
}
