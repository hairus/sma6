<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpPem extends Model
{
    protected $table = 'UpPem';
    protected $guarded = [];

    public function mapel()
    {
        return $this->belongsTo('App\Models\mapels', 'mapel_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'guru_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo('App\Models\mapel_kelas', 'mapel_id', 'mapel_id');
    }

    public function PenKD()
    {
        return $this->belongsTo('App\Models\PenKd', 'mapel_id', 'mapel_id');
    }

    public function Pfile()
    {
        return $this->belongsToMany('App\Models\PenKd', 'App\Model\file_siswa', 'mapel_id','mapel_id');
    }
}
