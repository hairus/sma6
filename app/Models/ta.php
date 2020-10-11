<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ta extends Model
{
  protected $table = 'tas';
  protected $guarded = [];

    public function tas()
    {
      //ta memiliki banyak Jurnal guru
      return $this->hasMany('App\Models\jurnals');
    }
}
