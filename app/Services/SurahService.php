<?php

namespace App\Services;

use App\Converter\SurahToSurahDataConverter;
use App\Models\SuraModel;

class SurahService
{
    protected $converter;

    public function __construct(SurahToSurahDataConverter $converter)
    {
        $this->converter = $converter;
    }

    public function getAllSuras()
    {
        try {
            $userId = auth()->id();
            $suras = SuraModel::with([
                'surahDetails',
                'bookmarks' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }
            ])->get();
            return $suras->map(function ($sura) {
                return $this->converter->convert($sura);
            });
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching suras.',
            ], 500);
        }
    }

}
