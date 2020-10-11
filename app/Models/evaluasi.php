<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class evaluasi extends Model
{
    protected $table ='evaluasis';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mapels()
    {
        return $this->belongsTo(mapels::class, 'mapel_id');
    }
}
