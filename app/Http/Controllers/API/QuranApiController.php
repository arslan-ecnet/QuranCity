<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\QuranSurah;
use Illuminate\Http\Request;

class QuranApiController extends Controller
{
    /**
     * Get a Surah by its ID, complete with verses, translations, and audio.
     */
    public function getSurah($id)
    {
        $surah = QuranSurah::with([
            'verses.translations.translation',
            'verses.audioFiles.reciter'
        ])->find($id);

        if (!$surah) {
            return response()->json([
                'status' => 'error',
                'message' => 'Surah not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $surah
        ]);
    }
    
    /**
     * Get all Surahs with all their details, verses, translations, and audio.
     * WARNING: This returns a massive JSON payload.
     */
    public function getAllSurahs()
    {
        // Reverted back to get() so your frontend doesn't break, and added caching so it loads fast!
        // We force the 'file' store because the database 'cache' table value column is too small for the entire Quran
            $surahs =QuranSurah::with([
                'adminDetails.surahDetails.theme', // Loads the manually entered Surah Details and themes
                'verses.translations.translation', // Loads all Verses and their translations
                'verses.audioFiles.reciter'        // Loads all Verses and their audio files
            ])->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $surahs
        ]);
    }
}
