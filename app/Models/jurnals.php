<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jurnals extends Model
{
  public function ta()
  {
    //dimana jurnal memiliki satu ta dari master ta
    return $this->hasOne('App\Models\ta', 'id', 'tas_id');
  }

  public function gurus()
  {
    return $this->hasOne('App\Models\Gurus','id', 'gurus_id');
  }

  public function mapels()
  {
    return $this->belongsTo('App\Models\mapels','mapel');
  }
	
  public function tas()
  {
	return $this->belongsTo('App\Models\ta','tas_id','id');
  }
}
