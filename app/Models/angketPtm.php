<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class angketPtm extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas_siswa::class, 'user_id', 'user_id');
    }
}
