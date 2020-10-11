<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mstSmt extends Model
{
    protected $table = 'mstSmt';
    protected $guarded = [];

    public function gMapel()
    {
        return $this->hasMany('App\Models\MstUkbm', 'smt', 'smt');
    }

}