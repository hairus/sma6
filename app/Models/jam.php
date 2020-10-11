<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jam extends Model
{
  protected $table = 'jam';
  protected $guarded = [];

  public function jams()
  {
    return $this->HasMany('App\Models\Absens', 'jam', 'jam_ke');
  }
}
