<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class point extends Model
{
    public function kelas()
    {
    	return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

    public function nama()
    {
	    return $this->belongsTo('App\Models\siswa', 'nis', 'nisn');
    }
}
