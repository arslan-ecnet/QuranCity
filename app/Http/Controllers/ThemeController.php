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
           'theme_color' => 'string|required',
        ]);
        $newTheme = new Theme();
        $newTheme->name = $request->name;
        $newTheme->theme_color = $request->theme_color;
        if ($request->hasFile('theme_image')) {
            $newTheme->theme_image = $this->uploadImage($request->file('theme_image'));
        }
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
            'theme_color' => 'string|required',
        ]);
        $updateTheme = Theme::find($id);
        $updateTheme->name = $request->name;
        $updateTheme->theme_color = $request->theme_color;
        if ($request->hasFile('theme_image')) {
            $updateTheme->theme_image = $this->uploadImage($request->file('theme_image'));
        }
        $updateTheme->save();
        return redirect(route('themeList'));
    }
    public function delete($id)
    {
        $deteleTheme = Theme::find($id);
        $deteleTheme->delete();
        return redirect(route('themeList'));
    }
    private function uploadImage($image)
    {
        if ($image) {
            $path = $image->store('theme_image', 'public');
            return 'theme_image/' . basename($path);
        }
        return null;
    }
}
