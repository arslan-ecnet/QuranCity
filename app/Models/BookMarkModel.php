<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookMarkModel extends Model
{
    protected $table = 'bookmarks';
    protected $fillable = [
        'user_id',
        'surah_id',
        'note'
        ];
}
