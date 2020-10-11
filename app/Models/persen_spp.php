<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class persen_spp extends Model
{
    // cara membuat tabel pivot antara persen dan siswa
    // dengan menggunakan table potongan_siswa
    public function potSiswa()
    {
        return $this->belongsToMany(siswa::class, 'potongan_siswa', 'persen_id', 'siswa_id');
    }

    public function potong()
    {
        return $this->belongsTo(persen_spp::class);
    }
}
