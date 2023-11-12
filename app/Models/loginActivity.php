<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loginActivity extends Model
{
    use HasFactory;
    protected $table = 'login_activity';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rekapLogin($role)
    {
        return $this->with('user')->whereHas('user', function ($query) use ($role) {
            $query->where('role_id', '!=', $role);
        });
    }

    public function scopeRekap($query, $operator)
    {
        $query->whereHas('user', function ($query) use ($operator) {
            $query->where('nama', 'like', '%' . $operator . '%')->orWhere('username', 'like', '%' . $operator . '%');
        });
    }
}
