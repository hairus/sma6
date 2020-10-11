<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ppd extends Model
{
    protected $table = 'ppds';
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'nis', 'nis');
    }

    public function guru()
    {
        return $this->belongsTo('App\User', 'guru_id', 'id');
    }

    public function mapels()
    {
        return $this->belongsTo(mapels::class, 'mapel_id');
    }
}
