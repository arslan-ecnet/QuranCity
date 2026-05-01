<?php

namespace App\Http\Controllers;

use App\Models\QuranSurah;
use App\Models\SuraModel;
use Illuminate\Http\Request;

class SuraController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = SuraModel::query();

            // Search
            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query->where(function($q) use ($searchValue) {
                    $q->where('name_english', 'like', "%{$searchValue}%")
                      ->orWhere('name_arabic', 'like', "%{$searchValue}%")
                      ->orWhere('name_transliteration', 'like', "%{$searchValue}%");
                });
            }

            // Total records
            $totalRecords = SuraModel::count();

            // Filtered records
            $totalFiltered = $query->count();

            // Order
            if ($request->has('order')) {
                $orderColumnIndex = $request->order[0]['column'];
                $orderDir = $request->order[0]['dir'];
                $columns = ['id', 'name_english', 'name_arabic', 'name_transliteration', 'revelation_type', 'revelation_order', 'total_verses', 'rukus', 'hizb_number', 'juz_start', 'juz_end'];

                if (isset($columns[$orderColumnIndex])) {
                    $query->orderBy($columns[$orderColumnIndex], $orderDir);
                }
            }

            // Pagination
            if ($request->has('start') && $request->has('length') && $request->length != -1) {
                $query->skip($request->start)->take($request->length);
            }

            $surahs = $query->get();

            $data = [];
            foreach ($surahs as $surah) {
                $editUrl = route('surahEdit', ['id' => $surah->id]);
                $deleteUrl = route('surahDelete', ['id' => $surah->id]);

                $data[] = [
                    $surah->id,
                    $surah->name_english,
                    $surah->name_arabic,
                    $surah->name_transliteration,
                    ucfirst($surah->revelation_type),
                    $surah->revelation_order,
                    $surah->total_verses,
                    $surah->rukus,
                    $surah->hizb_number,
                    $surah->juz_start,
                    $surah->juz_end,
                    '<a href="'.$editUrl.'" class="btn btn-sm btn-info text-white mb-1" style="background-color: #CAAE78;border-color: #CAAE78">Edit</a><br>' .
                    '<a href="'.$deleteUrl.'" class="btn btn-sm btn-info text-white" style="background-color: #561B06;border-color: #561B06" onclick="return confirm(\'Are you sure you want to delete this surah?\');">Delete</a>'
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $totalFiltered,
                "data" => $data
            ]);
        }

        return view('surah.list');
    }

    public function create()
    {
        return view('surah.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name_english' => 'required',
            'name_arabic' => 'required',
        ]);

        SuraModel::create($request->except('_token'));

        return redirect()->route('surahList')->with('success', 'Surah created successfully.');
    }

    public function edit($id)
    {
        $surah = SuraModel::findOrFail($id);
        return view('surah.edit', compact('surah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_english' => 'required',
            'name_arabic' => 'required',
        ]);

        $surah = SuraModel::findOrFail($id);
        $surah->update($request->except('_token'));

        return redirect()->route('surahList')->with('success', 'Surah updated successfully.');
    }

    public function delete($id)
    {
        $surah = SuraModel::findOrFail($id);
        $surah->delete();

        return redirect()->route('surahList')->with('success', 'Surah deleted successfully.');
    }
}
