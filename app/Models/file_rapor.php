<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class file_rapor extends Model
{
    public function name()
    {
        return $this->belongsTo(siswa::class, 'siswa_id', 'id');
    }
}
