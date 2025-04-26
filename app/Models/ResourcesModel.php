<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourcesModel extends Model
{
    protected $table = 'resources'; // use correct table name here

    protected $fillable = [
        'sura_id', 'title', 'type', 'url'
    ];

    public function sura()
    {
        return $this->belongsTo(SuraModel::class, 'sura_id', 'id');
    }
}
