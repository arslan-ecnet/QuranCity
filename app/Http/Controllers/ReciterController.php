<?php

namespace App\Http\Controllers;

use App\Models\Reciter;
use Illuminate\Http\Request;

class ReciterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Reciter::query();

            if ($request->has('search') && !empty($request->search['value'])) {
                $searchValue = $request->search['value'];
                $query->where('name', 'like', "%{$searchValue}%")
                      ->orWhere('style', 'like', "%{$searchValue}%");
            }

            $totalRecords = Reciter::count();
            $totalFiltered = $query->count();

            if ($request->has('order')) {
                $orderColumnIndex = $request->order[0]['column'];
                $orderDir = $request->order[0]['dir'];
                $columns = ['id', 'name', 'style'];

                if (isset($columns[$orderColumnIndex])) {
                    $query->orderBy($columns[$orderColumnIndex], $orderDir);
                }
            }

            if ($request->has('start') && $request->has('length') && $request->length != -1) {
                $query->skip($request->start)->take($request->length);
            }

            $reciters = $query->get();
            $data = [];
            foreach ($reciters as $reciter) {
                $editUrl = route('reciterEdit', ['id' => $reciter->id]);
                $deleteUrl = route('reciterDelete', ['id' => $reciter->id]);

                $data[] = [
                    $reciter->id,
                    $reciter->name,
                    $reciter->style,
                    '<a href="'.$editUrl.'" class="btn btn-sm btn-info text-white me-1" style="background-color: #CAAE78;border-color: #CAAE78">Edit</a>' .
                    '<a href="'.$deleteUrl.'" class="btn btn-sm btn-info text-white" style="background-color: #561B06;border-color: #561B06" onclick="return confirm(\'Are you sure you want to delete this reciter?\');">Delete</a>'
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $totalFiltered,
                "data" => $data
            ]);
        }
        return view('reciter.list');
    }

    public function create()
    {
        return view('reciter.create');
    }

    public function save(Request $request)
    {
        $request->validate(['name' => 'required']);
        Reciter::create($request->except('_token'));
        return redirect()->route('reciterList')->with('success', 'Reciter created successfully.');
    }

    public function edit($id)
    {
        $reciter = Reciter::findOrFail($id);
        return view('reciter.edit', compact('reciter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $reciter = Reciter::findOrFail($id);
        $reciter->update($request->except('_token'));
        return redirect()->route('reciterList')->with('success', 'Reciter updated successfully.');
    }

    public function delete($id)
    {
        Reciter::findOrFail($id)->delete();
        return redirect()->route('reciterList')->with('success', 'Reciter deleted successfully.');
    }
}
