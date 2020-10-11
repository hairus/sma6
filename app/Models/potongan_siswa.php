<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class potongan_siswa extends Model
{
    protected $table = 'potongan_siswa';
    protected $guarded = [];

    public function siswas()
    {
        return $this->belongsTo(siswa::class, 'siswa_id');
    }

    public function persens()
    {
        return $this->belongsTo(persen_spp::class, 'persen_id');
    }
}
