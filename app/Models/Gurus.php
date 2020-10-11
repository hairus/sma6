<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gurus extends Model
{
      protected $table = 'gurus';
      protected $guarded = [];

      public function roles()
      {
        return $this->belongsTo('App\User', 'nama', 'name');
      }
      
      public function jurnals()
      {
        return $this->belongsTo('App\Models\Gurus');
      }

      public function user()
      {
        return $this->hasOne('App\User', 'name', 'nama');
      }
}
