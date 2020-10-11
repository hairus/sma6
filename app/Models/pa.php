<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class pa extends Model
{
    protected $table = 'pa';
    protected $guarded = [];
    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'guru_id', 'id');
    }
}
