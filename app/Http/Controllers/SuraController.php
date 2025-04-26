<?php

namespace App\Http\Controllers;

use App\Models\ResourcesModel;
use App\Models\SuburbModel;
use App\Models\SuraDetailModel;
use App\Models\SuraModel;
use App\Models\Theme;
use Illuminate\Http\Request;

class SuraController extends Controller
{
    public function index()
    {
        $suras = SuraModel::all();
        return view('sura.list' , ['suras' => $suras]);
    }
    public function create()
    {
        return view('sura.create');
    }
    public function save(Request $request)
    {
        $ayatTitles = $request->input('ayat_title', []);
        $ayatSummaries = $request->input('ayat_summary', []);

        $selectedAyat = [];

        foreach ($ayatTitles as $index => $title) {
            if (!empty($title) && !empty($ayatSummaries[$index])) {
                $selectedAyat[] = [
                    'ayat' => $title,
                    'summary' => $ayatSummaries[$index],
                ];
            }
        }
        $request->validate([
           'name' => 'required',
           'surah_number' => 'required',
           'total_verses' => 'required',
           'classification' => 'required',
           'sub_classification' => 'required',
           'description' => 'required',
           'summary' => 'required',
           'focus' => 'required',
           'did_you_know' => 'required',
           'benefits_of_recitation' => 'required',
//           'selected_ayat' => 'required',
            'surah_icon' => 'required',
        ]);
        $sura = new SuraModel();
        $sura->name = $request->name;
        $sura->surah_number = $request->surah_number;
        $sura->total_verses = $request->total_verses;
        $sura->classification = $request->classification;
        $sura->sub_classification = $request->sub_classification;
        $sura->description = $request->description;
        $sura->summary = $request->summary;
        $sura->focus = json_encode($request->input('focus', []));
        $sura->did_you_know = json_encode($request->input('did_you_know', []));
        $sura->benefits_of_recitation = json_encode($request->input('benefits_of_recitation', []));
        $sura->selected_ayat = json_encode($selectedAyat);
        if ($request->hasFile('surah_icon')) {
            $sura->surah_icon = $this->uploadImage($request->file('surah_icon'));
        }
        $sura->save();
        return redirect(route('surahList'));
    }
    public function edit($id)
    {
        $surah = SuraModel::find($id);
        $surah->focus = json_decode($surah->focus, true);
        $surah->did_you_know = json_decode($surah->did_you_know, true);
        $surah->benefits_of_recitation = json_decode($surah->benefits_of_recitation, true);
        $surah->selected_ayat = json_decode($surah->selected_ayat, true) ?? [];
        return view('sura.edit' , ['surah' => $surah]);
    }
    public function update(Request $request , $id)
    {
        $ayatTitles = $request->input('ayat_title', []);
        $ayatSummaries = $request->input('ayat_summary', []);

        $selectedAyat = [];

        foreach ($ayatTitles as $index => $title) {
            if (!empty($title) && !empty($ayatSummaries[$index])) {
                $selectedAyat[] = [
                    'ayat' => $title,
                    'summary' => $ayatSummaries[$index],
                ];
            }
        }
        $request->validate([
            'name' => 'required',
            'surah_number' => 'required',
            'total_verses' => 'required',
            'classification' => 'required',
            'sub_classification' => 'required',
            'description' => 'required',
            'summary' => 'required',
            'focus' => 'required',
            'did_you_know' => 'required',
            'benefits_of_recitation' => 'required',
        ]);
        $sura = SuraModel::find($id);
        $sura->name = $request->name;
        $sura->surah_number = $request->surah_number;
        $sura->total_verses = $request->total_verses;
        $sura->classification = $request->classification;
        $sura->sub_classification = $request->sub_classification;
        $sura->description = $request->description;
        $sura->summary = $request->summary;
        $sura->focus = json_encode($request->input('focus', []));
        $sura->did_you_know = json_encode($request->input('did_you_know', []));
        $sura->benefits_of_recitation = json_encode($request->input('benefits_of_recitation', []));
        $sura->selected_ayat = json_encode($selectedAyat);
        if ($request->hasFile('surah_icon')) {
            $sura->surah_icon = $this->uploadImage($request->file('surah_icon'));
        }
        $sura->save();
        return redirect(route('surahList'));
    }
    public function delete($id)
    {
        $sura = SuraModel::find($id);
        $sura->delete();
        return redirect(route('surahList'));
    }
    private function uploadImage($image)
    {
        if ($image) {
            $path = $image->store('surah_icon', 'public');
            return 'surah_icon/' . basename($path);
        }
        return null;
    }

}
