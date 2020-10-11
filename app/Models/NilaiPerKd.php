<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiPerKd extends Model
{
    protected $table = 'NilaiPerKd';
    protected $guarded =[];

    public function siswa()
    {
        return $this->belongsTo('App\Models\siswa', 'nis','nisn');
    }

    public function scopeKat($query, $kat, $value)
    {
        return $query->where($kat ,$value);
    }

}
