<?php

namespace App;

use App\Models\kelas;
use App\Models\trxUpload;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nis', 'role', 'nis', 'kelas_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }

    public function uploads()
    {
        return $this->hasOne(trxUpload::class, 'siswa_id', 'id');
    }
}
