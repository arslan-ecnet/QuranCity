<?php

namespace App\Http\Controllers\API;

use App\Data\SurahData;
use App\Http\Controllers\Controller;
use App\Models\BookMarkModel;
use App\Models\ResourcesModel;
use App\Models\SuraModel;
use App\Services\SurahService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuraController extends Controller
{
    public function index(SurahService $suraService)
    {
        $suras = $suraService->getAllSuras();
        return response()->json([
            'data' => $suras,
        ], 200);
    }
    public function bookmark(Request $request)
    {
        try {
            $request->validate([
                'surah_id' => 'required|exists:surahs,id',
            ]);

            $userId = Auth::id();

            $existingBookmark = BookmarkModel::where('user_id', $userId)
                ->where('surah_id', $request->surah_id)
                ->first();

            if ($existingBookmark) {
                $existingBookmark->delete();

                return response()->json([
                    'message' => 'Bookmark removed successfully.',
                    'bookmarked' => false,
                ], 200);
            } else {
                BookmarkModel::create([
                    'user_id' => $userId,
                    'surah_id' => $request->surah_id,
                ]);

                return response()->json([
                    'message' => 'Bookmark added successfully.',
                    'bookmarked' => true,
                ], 201);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
