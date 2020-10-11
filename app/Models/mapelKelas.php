<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mapelKelas extends Model
{
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mapels()
    {
        return $this->belongsTo(mapels::class, 'mapel_id');
    }
}
