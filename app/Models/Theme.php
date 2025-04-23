<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    public function suras()
    {
        return $this->hasMany(Quran::class);
    }

}
