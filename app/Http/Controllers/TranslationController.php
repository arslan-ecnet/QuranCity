<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Translation::query();

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query->where('name', 'like', "%{$searchValue}%")
                      ->orWhere('language', 'like', "%{$searchValue}%")
                      ->orWhere('author', 'like', "%{$searchValue}%");
            }

            $totalRecords = Translation::count();
            $totalFiltered = $query->count();

            if ($request->has('order')) {
                $orderColumnIndex = $request->order[0]['column'];
                $orderDir = $request->order[0]['dir'];
                $columns = ['id', 'name', 'language', 'author', 'year'];

                if (isset($columns[$orderColumnIndex])) {
                    $query->orderBy($columns[$orderColumnIndex], $orderDir);
                }
            }

            if ($request->has('start') && $request->has('length') && $request->length != -1) {
                $query->skip($request->start)->take($request->length);
            }

            $translations = $query->get();
            $data = [];
            foreach ($translations as $translation) {
                $editUrl = route('translationEdit', ['id' => $translation->id]);
                $deleteUrl = route('translationDelete', ['id' => $translation->id]);

                $data[] = [
                    $translation->id,
                    $translation->name,
                    $translation->language,
                    $translation->author,
                    $translation->year,
                    '<a href="'.$editUrl.'" class="btn btn-sm btn-info text-white me-1" style="background-color: #CAAE78;border-color: #CAAE78">Edit</a>' .
                    '<a href="'.$deleteUrl.'" class="btn btn-sm btn-info text-white" style="background-color: #561B06;border-color: #561B06" onclick="return confirm(\'Are you sure you want to delete this translation?\');">Delete</a>'
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $totalFiltered,
                "data" => $data
            ]);
        }
        return view('translation.list');
    }

    public function create()
    {
        return view('translation.create');
    }

    public function save(Request $request)
    {
        $request->validate(['name' => 'required', 'language' => 'required']);
        Translation::create($request->except('_token'));
        return redirect()->route('translationList')->with('success', 'Translation created successfully.');
    }

    public function edit($id)
    {
        $translation = Translation::findOrFail($id);
        return view('translation.edit', compact('translation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required', 'language' => 'required']);
        $translation = Translation::findOrFail($id);
        $translation->update($request->except('_token'));
        return redirect()->route('translationList')->with('success', 'Translation updated successfully.');
    }

    public function delete($id)
    {
        Translation::findOrFail($id)->delete();
        return redirect()->route('translationList')->with('success', 'Translation deleted successfully.');
    }
}
