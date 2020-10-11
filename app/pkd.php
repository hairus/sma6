<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pkd extends Model
{
    //use SoftDeletes;
    protected $dates =['deleted_at'];

    public function kls()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Models\mapels', 'mapel_id', 'id');
    }

    public function guru()
    {
        return $this->belongsTo('App\User', 'guru_id', 'id');
    }

    public function ppd()
    {
        return $this->hasMany('App\Models\ppd');
    }

    public function tas()
    {
        return $this->belongsTo('App\Models\ta', 'ta_id', 'id');
    }


}
