<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenKd extends Model
{
    protected $table = 'PenKD';
    protected $guarded =[];

    public function Ukbm()
    {
        return $this->belongsTo('App\Models\mstUkbm', 'kd', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Models\siswa', 'nis', 'nisn');
    }

    public function mapels()
    {
        return $this->belongsTo('App\Models\mapels','mapel_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas','kelas_id', 'id');
    }

    public function file()
    {
        return $this->hasMany('App\Models\UpPem', 'kd_id', 'kd');
    }

    public function mapel_kelas()
    {
        return $this->belongsTo('App\Models\mapel_kelas', 'mapel_id', 'mapel_id');
    }

    public function Pfile()
    {
        return $this->belongsTo('App\Models\file_siswa','nis','nis');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'guru_id', 'id');
    }
}
