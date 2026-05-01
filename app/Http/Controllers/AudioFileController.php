<?php

namespace App\Http\Controllers;

use App\Models\AudioFile;
use App\Models\Reciter;
use Illuminate\Http\Request;

class AudioFileController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = AudioFile::with('reciter');

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query->where(function($q) use ($searchValue) {
                    $q->where('url', 'like', "%{$searchValue}%")
                      ->orWhere('verse_id', 'like', "%{$searchValue}%")
                      ->orWhereHas('reciter', function($q2) use ($searchValue) {
                          $q2->where('name', 'like', "%{$searchValue}%");
                      });
                });
            }

            $totalRecords = AudioFile::count();
            $totalFiltered = $query->count();

            if ($request->has('order')) {
                $orderColumnIndex = $request->order[0]['column'];
                $orderDir = $request->order[0]['dir'];
                $columns = ['id', 'verse_id', 'reciter_id', 'url', 'duration'];

                if (isset($columns[$orderColumnIndex])) {
                    if ($columns[$orderColumnIndex] == 'reciter_id') {
                        $query->orderBy('reciter_id', $orderDir);
                    } else {
                        $query->orderBy($columns[$orderColumnIndex], $orderDir);
                    }
                }
            }

            if ($request->has('start') && $request->has('length') && $request->length != -1) {
                $query->skip($request->start)->take($request->length);
            }

            $audioFiles = $query->get();
            $data = [];
            foreach ($audioFiles as $audio) {
                $editUrl = route('audioFileEdit', ['id' => $audio->id]);
                $deleteUrl = route('audioFileDelete', ['id' => $audio->id]);

                $data[] = [
                    $audio->id,
                    $audio->verse_id,
                    $audio->reciter ? $audio->reciter->name : $audio->reciter_id,
                    $audio->url,
                    $audio->duration,
                    '<a href="'.$editUrl.'" class="btn btn-sm btn-info text-white me-1" style="background-color: #CAAE78;border-color: #CAAE78">Edit</a>' .
                    '<a href="'.$deleteUrl.'" class="btn btn-sm btn-info text-white" style="background-color: #561B06;border-color: #561B06" onclick="return confirm(\'Are you sure you want to delete this audio file?\');">Delete</a>'
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $totalFiltered,
                "data" => $data
            ]);
        }
        return view('audio-file.list');
    }

    public function create()
    {
        $reciters = Reciter::all();
        return view('audio-file.create', compact('reciters'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'verse_id' => 'required|numeric',
            'reciter_id' => 'required',
            'url' => 'required'
        ]);
        AudioFile::create($request->except('_token'));
        return redirect()->route('audioFileList')->with('success', 'Audio File created successfully.');
    }

    public function edit($id)
    {
        $audioFile = AudioFile::findOrFail($id);
        $reciters = Reciter::all();
        return view('audio-file.edit', compact('audioFile', 'reciters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'verse_id' => 'required|numeric',
            'reciter_id' => 'required',
            'url' => 'required'
        ]);
        $audioFile = AudioFile::findOrFail($id);
        $audioFile->update($request->except('_token'));
        return redirect()->route('audioFileList')->with('success', 'Audio File updated successfully.');
    }

    public function delete($id)
    {
        AudioFile::findOrFail($id)->delete();
        return redirect()->route('audioFileList')->with('success', 'Audio File deleted successfully.');
    }
}
