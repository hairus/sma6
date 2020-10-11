<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    protected $table = 'soals';

    public function mapels()
    {
        return $this->belongsTo(mapels::class, 'mapel_id', 'id');
    }

    public function kd()
    {
        return $this->belongsTo(kdMapel::class, 'kd_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'guru_id', 'id');
    }

}
