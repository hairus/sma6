<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class log_materi extends Model
{
    public $incrementing = false;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mapels()
    {
        return $this->belongsTo(mapels::class, 'mapel_id');
    }
}
