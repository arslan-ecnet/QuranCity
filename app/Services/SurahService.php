<?php

namespace App\Services;

use App\Converter\SurahToSurahDataConverter;
use App\Models\SuraModel;
use Illuminate\Support\Facades\Log;

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

            // Check if user is authenticated
            if (!$userId) {
                throw new \Exception('User not authenticated.');
            }

            $suras = SuraModel::with([
                'surahDetails',
                'bookmarks' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }
            ])->get();

            Log::info('Suras fetched successfully for user', ['user_id' => $userId]);

            return $suras->map(function ($sura) {
                return $this->converter->convert($sura);
            });

        } catch (\Exception $e) {
            Log::error('Error in getAllSuras:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An error occurred while fetching suras.'
            ], 500);
        }
    }


}
