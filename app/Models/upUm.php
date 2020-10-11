<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class upUm extends Model
{
    protected $table = 'UpUm';
    protected $guarded = [];

    public function nGurus()
    {
        return $this->belongsTo('App\Models\Gurus', 'gurus_id', 'id');
    }

    public function Tanya()
    {
        return $this->belongsTo('App\Models\ta', 'tas_id', 'id');
    }
}
