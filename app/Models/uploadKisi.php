<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class uploadKisi extends Model
{
    public function mapels()
    {
        return $this->belongsTo(mapels::class, 'mapel_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
