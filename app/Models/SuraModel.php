<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BookMarkModel;
use  App\Models\SuraDetailModel;
class SuraModel extends Model
{
    protected $table = 'surahs';
    public function surahDetails()
    {
        return $this->hasMany(SuraDetailModel::class, 'surah_id', 'id');
    }
    public function bookmarks()
    {
        return $this->hasMany(BookmarkModel::class, 'surah_id', 'id');

    }
}
