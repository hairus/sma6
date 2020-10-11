<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class set_ujian extends Model
{
    public function ju()
    {
        return $this->belongsTo('App\Models\ju', 'ju_id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Models\mapels', 'mapel_id', 'id');
    }

    public function jurusan()
    {
        return $this->belongsTo('App\Models\jurusan', 'jur_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\models\Kelas', 'kelas_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'creator');
    }

}
