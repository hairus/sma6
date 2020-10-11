<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mst_operator extends Model
{
    protected $table ='mst_operator';
    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Models\mapels', 'mapel_id', 'id');
    }

    public function ju()
    {
        return $this->belongsTo('App\Models\ju', 'ju_id', 'id');
    }

    public function jurusan()
    {
        return $this->belongsTo('App\Models\jurusan', 'jur_id', 'id');
    }
}