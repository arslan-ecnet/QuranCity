<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find($request->id);
        return view('profile' , ['user' => $user]);
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $user->name = $request->name;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return back()->with('success', 'Profile updated successfully!');
    }

}
