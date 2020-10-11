<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Absens extends Model
{
    protected $table = 'absens';
    protected $guarded = [];

    public function Kelass()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

    public function siswas()
    {
        return $this->belongsTo('App\Models\siswa', 'nisn', 'nisn');
    }

    public function absens()
    {
        return $this->hasMany('App\Models\siswa', 'nisn', 'nisn');
    }

    public function tas()
    {
        return $this->belongsTo('App\Models\ta');
    }

    public function gurus()
    {
        return $this->belongsTo('App\Models\Gurus');
    }

    public function jams()
    {
        return $this->belongsTo('App\Models\jam', 'jam_ke', 'jam');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'nisn', 'nis');
    }
}
