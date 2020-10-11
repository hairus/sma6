<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class guru_mapel extends Model
{
    protected $table = 'guru_mapel';

    public function mapels()
    {
        return $this->belongsTo(mapels::class, 'mapel_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'guru_id', 'id');
    }
}
