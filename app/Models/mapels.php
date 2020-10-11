<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mapels extends Model
{
    protected $guarded = [];

    public function tas()
    {
        return $this->belongsTo('App\Models\ta', 'tas_id', 'id');
    }

    public function kdRpp()
    {
        /* ini dari table mapels ke mstUkbm dimana (MAPEL mempunyai banyak UKMB dan yang di jadikan foreign key adalah mapel_id dari tabel mst_ukm tersebut
        */
        return $this->HasMany('App\Models\mstUkbm', 'mapel_id');
    }

    public function NA()
    {
        return $this->hasMany('App\Models\NA', 'mapel_id', 'id');
    }

    public function nilai_kd()
    {
        return $this->hasMany('App\Models\PenKd', 'mapel_id', 'id');
    }

    public function np()
    {
        return $this->hasMany('App\Models\ppd', 'mapel_id', 'id');
    }
}
