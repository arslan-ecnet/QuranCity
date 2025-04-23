<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        return view('theme.list', ['themes' => $themes]);
    }
    public function create()
    {
        return view('theme.create');
    }
    public function save(Request $request)
    {
        $request->validate([
           'name' => 'string|required',
           'description' => 'string|required',
           'theme_color' => 'string|required',
           'sort_order' => 'string|required',
        ]);
        $newTheme = new Theme();
        $newTheme->name = $request->name;
        $newTheme->description = $request->description;
        $newTheme->theme_color = $request->theme_color;
        $newTheme->sort_order = $request->sort_order;
        $newTheme->save();
        return redirect(route('themeList'));
    }
    public function edit($id)
    {
        $theme = Theme::find($id);
        return view('theme.edit' , ['theme' => $theme]);
    }
    public function update(Request $request , $id)
    {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'theme_color' => 'string|required',
            'sort_order' => 'string|required',
        ]);
        $updateTheme = Theme::find($id);
        $updateTheme->name = $request->name;
        $updateTheme->description = $request->description;
        $updateTheme->theme_color = $request->theme_color;
        $updateTheme->sort_order = $request->sort_order;
        $updateTheme->save();
        return redirect(route('themeList'));
    }
    public function delete($id)
    {
        $deteleTheme = Theme::find($id);
        $deteleTheme->delete();
        return redirect(route('themeList'));
    }
}
