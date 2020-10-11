<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class penelaah extends Model
{
    protected $table = 'penelaahs';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mapels()
    {
        return $this->belongsTo(mapels::class, 'mapel_id', 'id');
    }
}
