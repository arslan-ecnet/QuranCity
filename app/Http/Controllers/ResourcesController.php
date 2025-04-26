<?php

namespace App\Http\Controllers;

use App\Models\ResourcesModel;
use App\Models\SuraModel;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    public function index()
    {
        $resources = ResourcesModel::all();
        return view('resource.list',['resources' => $resources]);
    }
    public function create()
    {
        $suras = SuraModel::all();
        return view('resource.create' , ['suras' => $suras]);
    }
    public function save(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'type' => 'required',
           'url' => 'required',
           'sura_id' => 'required',
        ]);
        $resource = new ResourcesModel();
        $resource->title = $request->title;
        $resource->type = $request->type;
        $resource->url = $request->url;
        $resource->sura_id = $request->sura_id;
        $resource->save();
        return redirect(route('resourceList'));
    }
    public function edit($id)
    {
        $resource = ResourcesModel::find($id);
        $suras = SuraModel::all();
        return view('resource.edit',['resource' => $resource , 'suras' => $suras]);
    }
    public function update(Request $request , $id)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'url' => 'required',
            'sura_id' => 'required',
        ]);
        $resource = ResourcesModel::find($id);
        $resource->title = $request->title;
        $resource->type = $request->type;
        $resource->url = $request->url;
        $resource->sura_id = $request->sura_id;
        $resource->save();
        return redirect(route('resourceList'));
    }
    public function delete($id)
    {
        $resource = ResourcesModel::find($id);
        $resource->delete();
        return redirect(route('resourceList'));
    }
}
