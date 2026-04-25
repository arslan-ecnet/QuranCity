<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verse extends Model
{
    use HasFactory;

    protected $table = 'verses';
    protected $guarded = [];

    public function surah()
    {
        return $this->belongsTo(QuranSurah::class, 'surah_id', 'id');
    }

    public function translations()
    {
        return $this->hasMany(VerseTranslation::class, 'verse_id', 'id');
    }

    public function audioFiles()
    {
        return $this->hasMany(AudioFile::class, 'verse_id', 'id');
    }
}
