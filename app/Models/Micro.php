<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Micro extends Model
{
    protected $table = 'micros';
    protected $guarded = [];

    public function name()
    {
        return $this->hasOne('App\Models\siswa', 'nisn', 'nis');
    }
}
