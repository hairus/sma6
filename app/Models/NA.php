<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NA extends Model
{
    protected $table = 'NA';
    protected $guarded = [];

    public function mapels()
    {
        return $this->belongsTo('App\Models\mapels', 'mapel_id', 'id');
    }
}
