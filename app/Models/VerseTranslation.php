<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerseTranslation extends Model
{
    use HasFactory;

    protected $table = 'verse_translations';
    protected $guarded = [];

    public function translation()
    {
        return $this->belongsTo(Translation::class, 'translation_id', 'id');
    }
}
