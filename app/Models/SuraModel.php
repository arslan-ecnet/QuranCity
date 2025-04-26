<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuraModel extends Model
{
    protected $table = 'surahs';
//    public function theme()
//    {
//        return $this->belongsTo(Theme::class);
//    }
//    public function resources()
//    {
//        return $this->hasMany(ResourcesModel::class, 'sura_id', 'id');
//    }
    public function suraDetails()
    {
        return $this->hasMany(SuraDetailModel::class, 'sura_id', 'id');
    }

}
