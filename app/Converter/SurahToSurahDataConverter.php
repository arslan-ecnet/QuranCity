<?php

namespace App\Converter;

use App\Data\SurahData;

class SurahToSurahDataConverter
{
    public function convert($sura)
    {
        try {
            $surahDetails = $sura->surahDetails->map(function ($detail) {
                $detail->summary = json_decode($detail->summary, true);
                return $detail;
            });

            return new SurahData(
                $sura->id,
                $sura->name,
                $sura->surah_number,
                $sura->total_verses,
                $sura->classification,
                $sura->sub_classification,
                $sura->description,
                $sura->summary,
                $sura->surah_icon ? asset('storage/' . $sura->surah_icon) : null,
                json_decode($sura->focus, true),
                json_decode($sura->did_you_know, true),
                json_decode($sura->benefits_of_recitation, true),
                json_decode($sura->selected_ayat, true),
                $surahDetails->toArray(),
                $sura->bookmarks->toArray(),
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while converting surah data.',
            ], 500);
        }
    }


}
