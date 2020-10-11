<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class log_view_pkpd extends Model
{
    protected $fillable = ['code', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
