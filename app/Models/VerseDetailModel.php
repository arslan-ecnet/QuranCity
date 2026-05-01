<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SuraModel;

class VerseDetailModel extends Model
{
    protected $table = 'verse_details';
    public function sura()
    {
        return $this->belongsTo(SuraModel::class, 'surah_id', 'id');
    }
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id', 'id');
    }
}
