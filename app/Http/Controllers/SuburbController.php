<?php

namespace App\Http\Controllers;

use App\Models\SuburbModel;
use Illuminate\Http\Request;

class SuburbController extends Controller
{
    public function index()
    {
        $suburbs = SuburbModel::all();
        return view('suburb.list' , ['suburbs' => $suburbs]);
    }
    public function create()
    {
        return view('suburb.create');
    }
    public function save(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'description' => 'required',
        ]);
        $suburb = new SuburbModel();
        $suburb->name = $request->name;
        $suburb->description = $request->description;
        $suburb->save();
        return redirect(route('suburbList'));
    }
    public function edit($id)
    {
        $suburb = SuburbModel::find($id);
        return view('suburb.edit' , ['suburb' => $suburb]);
    }
    public function update(Request $request , $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $suburb = SuburbModel::find($id);
        $suburb->name = $request->name;
        $suburb->description = $request->description;
        $suburb->save();
        return redirect(route('suburbList'));
    }
    public function delete($id)
    {
        $suburb = SuburbModel::find($id);
        $suburb->delete();
        return redirect(route('suburbList'));
    }
}
