<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class file_siswa extends Model
{
    protected $table = 'file_siswa';
    protected $guarded = [];

    public function UpPem()
    {
        return $this->belongsTo('App\Models\UpPem', 'mapel_id', 'mapel_id');
    }

    public function PenKd()
    {
        return $this->belongsTo('App\Models\PenKd', 'mapel_id', 'mapel_id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Models\mapels', 'mapel_id', 'id');
    }

    public function ukbm()
    {
        return $this->belongsTo('App\Models\mstUkbm', 'kd_id');
    }

}
