<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function parkir()
    {
        return $this->hasMany(Parkir::class);
    }

    public function loginActivity()
    {
        return $this->hasMany(loginActivity::class);
    }

    public function scopeOperator($query, $filter)
    {
        $query->when($filter ?? false, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')->orWhere('username','like','%'.$search.'%');
        });
    }

    public function pendapatan() {
        return $this->hasMany(Parkir::class)
        ->whereDate('tanggal_keluar',today())
        ->where('status','keluar')->sum('harga');
    }
}
