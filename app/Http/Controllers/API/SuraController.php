<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ResourcesModel;
use App\Models\SuraModel;
use Illuminate\Http\Request;

class SuraController extends Controller
{
    public function index()
    {
        $suras = SuraModel::all()->map(function ($sura) {
            return [
                'id' => $sura->id,
                'name' => $sura->name,
                'surah_number' => $sura->surah_number,
                'total_verses' => $sura->total_verses,
                'classification' => $sura->classification,
                'sub_classification' => $sura->sub_classification,
                'description' => $sura->description,
                'summary' => $sura->summary,
                'focus' => json_decode($sura->focus, true),
                'did_you_know' => json_decode($sura->did_you_know, true),
                'benefits_of_recitation' => json_decode($sura->benefits_of_recitation, true),
                'selected_ayat' => json_decode($sura->selected_ayat, true),
                'surah_icon' => $sura->surah_icon,
                'created_at' => $sura->created_at,
                'updated_at' => $sura->updated_at,
            ];
        });

        return response()->json([
            'data' => $suras,
        ], 200);
    }


}
