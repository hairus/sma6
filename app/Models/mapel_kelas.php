<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mapel_kelas extends Model
{
    protected $table = 'mapel_kelas';
    protected $guarded = [''];
    public function mapel()
    {
        return $this->belongsTo('App\Models\mapels', 'mapel_id', 'id');
    }

    public function NA()
    {
        return $this->belongsTo('App\Models\NA', 'mapel_id', 'mapel_id');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Models\siswa', 'nis', 'nisn');
    }

    public function file()
    {
        return $this->belongsTo('App\Models\UpPem', 'mapel_id', 'mapel_id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id');
    }

    public function nilaiPenKd()
    {
        return $this->hasOne('App\Models\PenKd', 'nis', 'nis');
    }

    public function np()
    {
        return $this->hasMany('App\Models\ppd', 'mapel_id', 'mapel_id');
    }

    public function materis()
    {
        return $this->hasMany(imateri::class, 'mapel_id', 'mapel_id');
    }
}
