<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SuraModel;

class SuraDetailModel extends Model
{
    protected $table = 'surah_details';
    public function sura()
    {
        return $this->belongsTo(SuraModel::class, 'surah_id', 'id');
    }
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id', 'id');
    }
}
