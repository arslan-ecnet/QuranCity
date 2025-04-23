<?php

namespace App\Http\Controllers;

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
        $themes = Theme::all();
        return view('sura.create' , ['themes' => $themes]);
    }
    public function save(Request $request)
    {
        $sura = new SuraModel();
        $sura->name_en = $request->name_en;
        $sura->name_ar = $request->name_ar;
        $sura->translation = $request->translation;
        $sura->classification = $request->classification;
        $sura->sub_classification = $request->sub_classification;
        $sura->verses_count = $request->verses_count;
        $sura->description = $request->description;
        $sura->summary = $request->summary;
        $sura->theme_id = $request->theme_id;
        $sura->revelation_order = $request->revelation_order;
        $sura->sura_color = $request->sura_color;
        if ($request->hasFile('sura_icon')) {
            $sura->sura_icon = $this->uploadImage($request->file('sura_icon'));
        }
        $sura->save();
        return redirect(route('suraList'));
    }
    public function edit($id)
    {
        $sura = SuraModel::find($id);
        $themes = Theme::all();
        return view('sura.edit' , ['sura' => $sura , 'themes' => $themes]);
    }
    public function update(Request $request , $id)
    {
        $sura = SuraModel::find($id);
        $sura->name_en = $request->name_en;
        $sura->name_ar = $request->name_ar;
        $sura->translation = $request->translation;
        $sura->classification = $request->classification;
        $sura->sub_classification = $request->sub_classification;
        $sura->verses_count = $request->verses_count;
        $sura->description = $request->description;
        $sura->summary = $request->summary;
        $sura->theme_id = $request->theme_id;
        $sura->revelation_order = $request->revelation_order;
        $sura->sura_color = $request->sura_color;
        if ($request->hasFile('sura_icon')) {
            $sura->sura_icon = $this->uploadImage($request->file('sura_icon'));
        }
        $sura->save();
        return redirect(route('suraList'));
    }
    public function delete($id)
    {
        $sura = SuraModel::find($id);
        $sura->delete();
        return redirect(route('suraList'));
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
