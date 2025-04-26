<?php

namespace App\Http\Controllers;

use App\Models\SuraDetailModel;
use App\Models\SuraModel;
use App\Models\Theme;
use Illuminate\Http\Request;

class SuraDetailController extends Controller
{
    public function index()
    {
        $suraDetails = SuraDetailModel::all();
        return view('sura-detail.list',['suraDetails' => $suraDetails]);
    }
    public function create()
    {
        $suras = SuraModel::all();
        $themes = Theme::all();
        return view('sura-detail.create',['suras' => $suras , 'themes' => $themes]);
    }
    public function save(Request $request)
    {
        $request->validate([
           'surah_id' => 'required',
           'theme_id' => 'required',
           'title' => 'required',
            'from' => 'required',
        ]);
        $suraDetail = new SuraDetailModel();
        $suraDetail->surah_id = $request->surah_id;
        $suraDetail->title = $request->title;
        $suraDetail->theme_id = $request->theme_id;
        $suraDetail->from = $request->from;
        $suraDetail->to = $request->to;
        $suraDetail->summary = json_encode($request->input('summary', []));

        $suraDetail->save();
        return redirect(route('surahDetailList'));
    }
    public function edit($id)
    {
        $suraDetail = SuraDetailModel::find($id);
        $suras = SuraModel::all();
        $themes = Theme::all();
        $suraDetail->summary = json_decode($suraDetail->summary, true);

        return view('sura-detail.edit' , ['suraDetatil' => $suraDetail , 'suras' => $suras , 'themes' => $themes]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'surah_id' => 'required',
            'theme_id' => 'required',
            'title' => 'required',
            'from' => 'required',
        ]);
        $suraDetail = SuraDetailModel::find($id);
        $suraDetail->surah_id = $request->surah_id;
        $suraDetail->title = $request->title;
        $suraDetail->theme_id = $request->theme_id;
        $suraDetail->from = $request->from;
        $suraDetail->to = $request->to;
        $suraDetail->summary = json_encode($request->input('summary', []));

        $suraDetail->save();
        return redirect(route('surahDetailList'));
    }
    public function delete($id)
    {
        $suraDetail = SuraDetailModel::find($id);
        $suraDetail->delete();
        return redirect(route('surahDetailList'));

    }
}
