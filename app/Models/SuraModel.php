<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuraModel extends Model
{
    protected $table = 'suras';
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
    public function resources()
    {
        return $this->hasMany(ResourcesModel::class);
    }
}
