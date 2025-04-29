<?php

namespace App\Converter;

use App\Data\SurahData;
use Illuminate\Support\Facades\Log;

class SurahToSurahDataConverter
{
    public function convert($sura)
    {
        try {
            $surahDetails = $sura->surahDetails?->map(function ($detail) {
                $detail->summary = json_decode($detail->summary ?? '[]', true);
                return $detail;
            }) ?? collect();

            $bookmarks = $sura->bookmarks ?? collect();

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
                json_decode($sura->focus ?? '[]', true),
                json_decode($sura->did_you_know ?? '[]', true),
                json_decode($sura->benefits_of_recitation ?? '[]', true),
                json_decode($sura->selected_ayat ?? '[]', true),
                $surahDetails->toArray(),
                $bookmarks->toArray(),
            );

        } catch (\Exception $e) {
            Log::error('Error in convert():', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An error occurred while converting surah data.'
            ], 500);
        }
    }



}
