<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ppdb_profile extends Model
{
    public function agama1()
    {
        return $this->belongsTo('App\Models\ppdb_agama', 'agama', 'id');
    }

    public function tinggal1()
    {
        return $this->belongsTo('App\Models\ppdb_tinggal', 'jenis_tinggal', 'id');
    }

    public function transportasi()
    {
        return $this->belongsTo('App\Models\ppdb_transportasi', 'alat_transportasi', 'id');
    }

    public function jenjanga()
    {
        return $this->belongsTo('App\Models\ppdb_pendidikanA', 'jenjang_pendidikana', 'id');
    }

    public function gajia()
    {
        return $this->belongsTo('App\Models\ppdb_range_gajiA', 'penghasilana', 'id');
    }

    public function pekerjaan_a()
    {
        return $this->belongsTo('App\Models\ppdb_pekerjaaanA', 'pekerjaana', 'id');
    }

    public function jenjangb()
    {
        return $this->belongsTo('App\Models\ppdb_pendidikanB', 'jenjang_pendidikani', 'id');
    }

    public function gajib()
    {
        return $this->belongsTo('App\Models\ppdb_range_gajiB', 'penghasilani', 'id');
    }

    public function pekerjaan_i()
    {
        return $this->belongsTo('App\Models\ppdb_pekerjaaanb', 'pekerjaani', 'id');
    }

    public function jenjangw()
    {
        return $this->belongsTo('App\Models\ppdb_pendidikanW', 'jenjang_pendidikanw', 'id');
    }

    public function gajiw()
    {
        return $this->belongsTo('App\Models\ppdb_range_gajiW', 'penghasilanw', 'id');
    }

    public function pekerjaan_w1()
    {
        return $this->belongsTo('App\Models\ppdb_pekerjaaanW', 'pekerjaanw', 'id');
    }

    public function minat1()
    {
        return $this->belongsTo('App\Models\ppdb_minat', 'minat_id', 'id');
    }

    public function osn1()
    {
        return $this->belongsTo('App\Models\ppdb_osn', 'osn_id', 'id');
    }

    public function user()
    {
    	return $this->hasOne('App\User', 'email', 'email');
    }

    public function nilais()
    {
        return $this->hasMany(angket_nilai::class, 'nun_profile', 'nun');
    }
}
