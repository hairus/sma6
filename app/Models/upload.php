<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class upload extends Model
{
  protected $tabel = 'uploads';
  protected $guarded = [];

    public function guruss()
    {
        return $this->belongsTo('App\Models\Gurus', 'gurus_id', 'id');
    }

    public function TaNya()
    {
        return $this->belongsTo('App\Models\ta', 'tas', 'id');
    }
}
