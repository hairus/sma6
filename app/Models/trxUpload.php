<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class trxUpload extends Model
{
    protected $table = 'trx_uploads';

    public function users()
    {
        return $this->belongsTo(User::class, 'siswa_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }
}
