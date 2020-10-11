<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $guarded = [];

    public function siswas()
    {
        return $this->hasMany('App\Models\siswa', 'kelas_id', 'id');
    }

    public function tas()
    {
        //tas_id dari table kelasnya dan id dari tabel ta nya
        return $this->belongsTo('App\Models\ta', 'tas_id', 'id');
    }

    public function Absens()
    {
        return $this->HasMany('App\Models\Absens');
    }

    public function pkd()
    {
        return $this->hasMany('App\pkd', 'kelas_id', 'id');
    }

    public function jur()
    {
        return $this->belongsTo('App\Models\jurusan', 'jur_id', 'id');
    }

    public function ksis()
    {
        return $this->hasMany(kelas_siswa::class);
    }
}
