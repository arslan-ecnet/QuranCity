<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookMarkModel;
use  App\Models\SuraDetailModel;
class SuraModel extends Model
{
    use HasFactory;

    protected $table = 'surahs';
    protected $guarded = [];

    public function verses()
    {
        return $this->hasMany(Verse::class, 'surah_id', 'id');
    }

    public function adminDetails()
    {
        return $this->hasOne(SurahDetail::class, 'surah_number', 'id');
    }
}
