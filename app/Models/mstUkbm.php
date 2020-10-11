<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mstUkbm extends Model
{
    protected $table = 'mstUkbm';
    protected $guarded = [];

    public function mapSks()
    {
        return $this->belongsTo('App\Models\mapels', 'mapel_id', 'id');
    }

    public function nilaikd()
    {
        return $this->hasMany('App\Models\PenKd', 'kd', 'id');
    }

    public function gMapel()
    {
        return $this->belongsTo('App\Models\mstSmt', 'smt', 'smt');
    }

}
