<?php

namespace App\Http\Controllers;

use App\Models\VerseTranslation;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VerseTranslationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = VerseTranslation::with('translation');

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query->where(function($q) use ($searchValue) {
                    $q->where('text', 'like', "%{$searchValue}%")
                      ->orWhere('verse_id', 'like', "%{$searchValue}%")
                      ->orWhereHas('translation', function($q2) use ($searchValue) {
                          $q2->where('name', 'like', "%{$searchValue}%")
                             ->orWhere('language', 'like', "%{$searchValue}%");
                      });
                });
            }

            $totalRecords = VerseTranslation::count();
            $totalFiltered = $query->count();

            if ($request->has('order')) {
                $orderColumnIndex = $request->order[0]['column'];
                $orderDir = $request->order[0]['dir'];
                $columns = ['id', 'verse_id', 'translation_id', 'text'];

                if (isset($columns[$orderColumnIndex])) {
                    if ($columns[$orderColumnIndex] == 'translation_id') {
                        $query->orderBy('translation_id', $orderDir);
                    } else {
                        $query->orderBy($columns[$orderColumnIndex], $orderDir);
                    }
                }
            }

            if ($request->has('start') && $request->has('length') && $request->length != -1) {
                $query->skip($request->start)->take($request->length);
            }

            $verseTranslations = $query->get();
            $data = [];
            foreach ($verseTranslations as $vt) {
                $editUrl = route('verseTranslationEdit', ['id' => $vt->id]);
                $deleteUrl = route('verseTranslationDelete', ['id' => $vt->id]);

                $translationName = $vt->translation ? $vt->translation->name . ' (' . $vt->translation->language . ')' : $vt->translation_id;

                $data[] = [
                    $vt->id,
                    $vt->verse->text_arabic,
                    $translationName,
                    '<span class="text-truncate" style="max-width: 200px; display:inline-block;" title="'.htmlspecialchars(strip_tags($vt->text)).'">'.Str::limit(strip_tags($vt->text), 50).'</span>',
                    '<a href="'.$editUrl.'" class="btn btn-sm btn-info text-white me-1" style="background-color: #CAAE78;border-color: #CAAE78">Edit</a>' .
                    '<a href="'.$deleteUrl.'" class="btn btn-sm btn-info text-white" style="background-color: #561B06;border-color: #561B06" onclick="return confirm(\'Are you sure you want to delete this verse translation?\');">Delete</a>'
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $totalFiltered,
                "data" => $data
            ]);
        }
        return view('verse-translation.list');
    }

    public function create()
    {
        $translations = Translation::all();
        return view('verse-translation.create', compact('translations'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'verse_id' => 'required|numeric',
            'translation_id' => 'required',
            'text' => 'required'
        ]);
        VerseTranslation::create($request->except('_token'));
        return redirect()->route('verseTranslationList')->with('success', 'Verse Translation created successfully.');
    }

    public function edit($id)
    {
        $verseTranslation = VerseTranslation::findOrFail($id);
        $translations = Translation::all();
        return view('verse-translation.edit', compact('verseTranslation', 'translations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'verse_id' => 'required|numeric',
            'translation_id' => 'required',
            'text' => 'required'
        ]);
        $verseTranslation = VerseTranslation::findOrFail($id);
        $verseTranslation->update($request->except('_token'));
        return redirect()->route('verseTranslationList')->with('success', 'Verse Translation updated successfully.');
    }

    public function delete($id)
    {
        VerseTranslation::findOrFail($id)->delete();
        return redirect()->route('verseTranslationList')->with('success', 'Verse Translation deleted successfully.');
    }
}
