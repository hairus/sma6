<?php

namespace App;

use App\Models\angket_file;
use App\Models\angket_nilai;
use App\Models\asisten;
use App\Models\berkas;
use App\Models\bk;
use App\Models\evaluasi;
use App\Models\guru_mapel;
use App\Models\kelas_siswa;
use App\Models\log_view_pkpd;
use App\Models\pa;
use App\Models\siswa;
use App\Models\Siswa_Lengkap;
use App\Models\soal;
use App\Models\uploadKisi;
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
        'name', 'email', 'password', 'nis', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function gurus()
    {
        return $this->belongsTo('App\Models\Gurus', 'name', 'nama');
    }

    public function GuruUkbm()
    {
        /*
        koding untuk menentukan banykanya kd yang ada dari setiap user tersebut
      */
        return $this->hasMany('App\Models\mstUkbm', 'guru_id', 'id');
    }

    public function siswas()
    {
        return $this->belongsToMany('App\Models\siswa', 'siswa_user', 'user_id', 'siswa_id');
    }

    public function siswa()
    {
        return $this->hasOne('App\Models\siswa', 'user_id', 'id');
    }

    public function guru()
    {
        return $this->hasOne('App\Models\Gurus', 'nama', 'name');
    }

    public function kelas_user()
    {
        return $this->hasOne('App\Models\siswa', 'nisn', 'nis');
    }

    public function mapel()
    {
        return $this->hasMany('App\pkd', 'guru_id', 'id');
    }

    public function roles()
    {
        return $this->belongsTo('App\Models\Role', 'role', 'role_id');
    }

    public function ppdb()
    {
        return $this->hasOne('App\Models\ppdb_profile', 'email', 'email');
    }

    public function peng()
    {
        return $this->hasOne('App\Models\ppdb_pengum', 'username_id', 'username');
    }

    public function absens()
    {
        return $this->hasOne('App\Models\RgHarian', 'user', 'name');
    }

    public function asistens()
    {
        return $this->hasOne(asisten::class, 'user_id', 'id');
    }

    public function soals()
    {
        return $this->hasMany(soal::class, 'guru_id', 'id');
    }

    public function guruMapel()
    {
        return $this->hasMany(guru_mapel::class, 'guru_id', 'id');
    }

    public function kisiSoals()
    {
        return $this->hasMany(uploadKisi::class, 'user_id', 'id');
    }

    public function evaluasi()
    {
        return $this->hasOne(evaluasi::class, 'user_id', 'id');
    }

    public function ppdbSiswaLeng()
    {
        return $this->hasOne(Siswa_Lengkap::class);
    }

    public function sibaNilai()
    {
        return $this->hasMany(angket_nilai::class, 'user_id', 'id');
    }

    public function koperasi()
    {
        return $this->hasMany(berkas::class, 'user_id', 'id');
    }

    public function kelas_siswas()
    {
        return $this->hasOne(kelas_siswa::class, 'user_id');
    }

    public function pa()
    {
        return $this->hasOne(pa::class, 'guru_id');
    }

    public function bk()
    {
        return $this->hasOne(bk::class);
    }

    public function log_view_pkpd()
    {
        return $this->hasOne(log_view_pkpd::class, 'user_id');
    }
}
