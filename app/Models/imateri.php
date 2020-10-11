<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class imateri extends Model
{


    protected $table = 'imateris';
    protected $guarded = [];


    public $incrementing = false;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapels()
    {
        return $this->belongsTo(mapels::class, 'mapel_id');
    }
}
