<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Siswa_Lengkap extends Model
{
    protected $table = 'siswa_lengkaps';
    protected $guarded = [];

    public function nama()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
