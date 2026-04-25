<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioFile extends Model
{
    use HasFactory;

    protected $table = 'audio_files';
    protected $guarded = [];

    public function reciter()
    {
        return $this->belongsTo(Reciter::class, 'reciter_id', 'id');
    }
}
