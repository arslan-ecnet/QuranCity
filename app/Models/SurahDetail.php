<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurahDetail extends Model
{
    protected $table = 'surah_details';
    public function surahDetails()
    {
        return $this->hasMany(SuraModel::class, 'surah_id', 'id');
    }
    public function bookmarks()
    {
        return $this->hasMany(BookmarkModel::class, 'surah_id', 'id');

    }
}
