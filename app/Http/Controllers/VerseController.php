<?php

namespace App\Http\Controllers;

use App\Models\QuranSurah;
use App\Models\SuraModel;
use App\Models\Verse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VerseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Verse::with('surah');

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query->where(function($q) use ($searchValue) {
                    $q->where('text_arabic', 'like', "%{$searchValue}%")
                      ->orWhere('text_simple', 'like', "%{$searchValue}%")
                      ->orWhere('ayah_number', 'like', "%{$searchValue}%")
                      ->orWhere('id', 'like', "%{$searchValue}%")
                      ->orWhereHas('surah', function($q2) use ($searchValue) {
                          $q2->where('name_english', 'like', "%{$searchValue}%")
                             ->orWhere('name_arabic', 'like', "%{$searchValue}%");
                      });
                });
            }
            $totalRecords = Verse::count();
            $totalFiltered = $query->count();
            if ($request->has('order')) {
                $orderColumnIndex = $request->order[0]['column'];
                $orderDir = $request->order[0]['dir'];
                $columns = ['id', 'surah_id', 'ayah_number', 'ayah_global_number', 'text_arabic', 'text_simple', 'sajdah', 'juz', 'hizb', 'rub_el_hizb', 'page_number'];

                if (isset($columns[$orderColumnIndex])) {
                    if ($columns[$orderColumnIndex] == 'surah_id') {
                        $query->orderBy('surah_id', $orderDir);
                    } else {
                        $query->orderBy($columns[$orderColumnIndex], $orderDir);
                    }
                }
            }

            if ($request->has('start') && $request->has('length') && $request->length != -1) {
                $query->skip($request->start)->take($request->length);
            }
            $verses = $query->get();
            $data = [];
            foreach ($verses as $verse) {
                $editUrl = route('verseEdit', ['id' => $verse->id]);
                $deleteUrl = route('verseDelete', ['id' => $verse->id]);

                $surahName = $verse->surah ? $verse->surah->name_english . ' (' . $verse->surah->name_arabic . ')' : $verse->surah_id;

                $data[] = [
                    $verse->id,
                    $surahName,
                    $verse->ayah_number,
                    $verse->ayah_global_number,
                    '<span class="text-truncate" style="max-width: 200px; display:inline-block;" title="'.htmlspecialchars(strip_tags($verse->text_arabic)).'">'.Str::limit(strip_tags($verse->text_arabic), 50).'</span>',
                    '<span class="text-truncate" style="max-width: 200px; display:inline-block;" title="'.htmlspecialchars(strip_tags($verse->text_simple)).'">'.Str::limit(strip_tags($verse->text_simple), 50).'</span>',
                    $verse->sajdah,
                    $verse->juz,
                    $verse->hizb,
                    $verse->rub_el_hizb,
                    $verse->page_number,
                    '<a href="'.$editUrl.'" class="btn btn-sm btn-info text-white mb-1" style="background-color: #CAAE78;border-color: #CAAE78">Edit</a><br>' .
                    '<a href="'.$deleteUrl.'" class="btn btn-sm btn-info text-white" style="background-color: #561B06;border-color: #561B06" onclick="return confirm(\'Are you sure you want to delete this verse?\');">Delete</a>'
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $totalFiltered,
                "data" => $data
            ]);
        }

        return view('verse.list');
    }

    public function create()
    {
        $quranSurahs = SuraModel::all();
        return view('verse.create', compact('quranSurahs'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'surah_id' => 'required',
            'ayah_number' => 'required|numeric',
        ]);

        Verse::create($request->except('_token'));

        return redirect()->route('verseList')->with('success', 'Verse created successfully.');
    }

    public function edit($id)
    {
        $verse = Verse::findOrFail($id);
        $quranSurahs = SuraModel::all();
        return view('verse.edit', compact('verse', 'quranSurahs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'surah_id' => 'required',
            'ayah_number' => 'required|numeric',
        ]);

        $verse = Verse::findOrFail($id);
        $verse->update($request->except('_token'));

        return redirect()->route('verseList')->with('success', 'Verse updated successfully.');
    }

    public function delete($id)
    {
        $verse = Verse::findOrFail($id);
        $verse->delete();

        return redirect()->route('verseList')->with('success', 'Verse deleted successfully.');
    }
}
