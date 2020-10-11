<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    protected $table = 'siswa';
    protected $guarded = [];

    public function Kelass()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

    public function Absen()
    {
        return $this->hasMany('App\Models\Absens', 'nisn', 'nisn');
    }

    public function nilaiSks()
    {
        return $this->belongsTo('App\Models\PenKD', 'nisn', 'nis');
    }

    public function nilaiKd()
    {
        return $this->belongsTo('App\Models\NilaiPerKd', 'nisn', 'nis');
    }

    public function NilaiAkhir()
    {
        return $this->belongsTo('App\Models\NA', 'nisn', 'nis');
    }

    public function kelas()
    {
        return $this->hasOne('App\Models\Kelas', 'id', 'kelas_id');
    }

    public function mapels()
    {
        return $this->hasMany('App\Models\mapel_kelas', 'nis', 'nisn');
    }

    public function nilaiKd1()
    {
        return $this->hasMany('App\Models\ppd', 'nis', 'nisn');
    }

    public function siswa()
    {
        return $this->hasOne('App\Models\tables_siswa', 'nis', 'nisn');
    }

    public function sisPot()
    {
        return $this->belongsToMany(persen_spp::class, 'potongan_siswa', 'siswa_id', 'persen_id');
    }

    public function Spot()
    {
        return $this->hasOne(potongan_siswa::class);
    }
}
