<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourcesModel extends Model
{
    protected $table = 'resources';
    public function sura()
    {
        return $this->belongsTo(SuraModel::class);
    }
}
