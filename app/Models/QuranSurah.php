<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuranSurah extends Model
{
    use HasFactory;

    protected $table = 'quran_surahs';
    protected $guarded = [];

    public function verses()
    {
        return $this->hasMany(Verse::class, 'surah_id', 'id');
    }

    public function adminDetails()
    {
        return $this->hasOne(SuraModel::class, 'surah_number', 'id');
    }
}
