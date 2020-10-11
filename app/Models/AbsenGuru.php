<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenGuru extends Model
{
    protected $tabel = 'absens_gurus';
    protected $guarded = [];

    public function ta_ids()
    {
      return $this->belongsTo('App\Models\ta', 'tas_id', 'id');
    }

    public function gurus()
    {
      return $this->belongsTo('App\Models\Gurus', 'gurus_id', 'id');
    }

    public function kelass()
    {
      return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'kd_kelas');
    }

    public function mapels()
    {
      return $this->belongsTo('App\Models\mapels', 'mapel', 'id');
    }
}
