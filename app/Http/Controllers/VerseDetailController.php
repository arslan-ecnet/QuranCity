<?php

namespace App\Http\Controllers;

use App\Models\SurahDetail;
use App\Models\SuraModel;
use App\Models\Theme;
use App\Models\VerseDetailModel;
use Illuminate\Http\Request;

class VerseDetailController extends Controller
{
    public function index()
    {
        $verseDetails = VerseDetailModel::all();
        return view('verse-detail.list',['verseDetails' => $verseDetails]);
    }
    public function create()
    {
        $surahs = SuraModel::all();
        $themes = Theme::all();
        return view('verse-detail.create',['suras' => $surahs , 'themes' => $themes]);
    }
    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'from' => 'required',
        ]);
        $verseDetail = new VerseDetailModel();
        $verseDetail->title = $request->title;
        $verseDetail->theme_id = $request->theme_id;
        $verseDetail->from = $request->from;
        $verseDetail->to = $request->to;
        $verseDetail->surah_id = $request->surah_id;
        $verseDetail->summary = json_encode($request->input('summary', []));

        $verseDetail->save();
        return redirect(route('versehDetailList'));
    }
    public function edit($id)
    {
        $verseDetail = VerseDetailModel::find($id);
        $surahs = SuraModel::all();
        $themes = Theme::all();
        $verseDetail->summary = json_decode($verseDetail->summary, true);

        return view('verse-detail.edit' , ['verseDetatil' => $verseDetail , 'suras' => $surahs , 'themes' => $themes]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'theme_id' => 'required',
            'title' => 'required',
            'surah_id' => 'required',
        ]);
        $verseDetail = VerseDetailModel::find($id);
        $verseDetail->title = $request->title;
        $verseDetail->surah_id = $request->surah_id;
        $verseDetail->theme_id = $request->theme_id;
        $verseDetail->from = $request->from;
        $verseDetail->to = $request->to;
        $verseDetail->summary = json_encode($request->input('summary', []));

        $verseDetail->save();
        return redirect(route('verseDetailList'));
    }
    public function delete($id)
    {
        $verseDetail = VerseDetailModel::find($id);
        $verseDetail->delete();
        return redirect(route('versehDetailList'));

    }
}
