<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kelas_siswa extends Model
{
    protected $fillable = [
        'user_id', 'kelas_id', 'nis', 'tas_id'
    ];
    use SoftDeletes;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function tas()
    {
        return $this->belongsTo(ta::class, 'tas_id');
    }

    public function materis()
    {
        return $this->hasMany(log_materi::class, 'user_id', 'user_id')->whereDay('created_at', date('d'));
    }

    public function nilaiKd1()
    {
        return $this->hasMany(ppd::class, 'nis', 'nis');
    }
}
