<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class surat extends Model
{
    protected $tabel = 'surats';
    protected $guarded = [];

    public function kategoris()
    {
        return $this->BelongsTo('App\Models\Tu_kode', 'kode_id', 'id');
    }
}
