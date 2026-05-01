<?php

namespace App\Http\Controllers;

use App\Models\Verse;
use Illuminate\Http\Request;

class VerseController extends Controller
{
    public function index()
    {
        $verses = Verse::all();
        return view('verse.list', compact('verses'));
    }
}
