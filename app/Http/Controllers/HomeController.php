<?php

namespace App\Http\Controllers;

use App\Models\SuraModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalSurahs = SuraModel::count();
        $labels = collect(range(0, 6))->map(function ($i) {
            return Carbon::now()->startOfWeek()->addDays($i)->format('D');
        });
        $thisWeekData = User::select(DB::raw('DAYOFWEEK(created_at) as day'), DB::raw('count(*) as count'))
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();
        $lastWeekData = User::select(DB::raw('DAYOFWEEK(created_at) as day'), DB::raw('count(*) as count'))
            ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();
        $thisWeek = [];
        $lastWeek = [];
        foreach (range(1, 7) as $day) {
            $thisWeek[] = $thisWeekData[$day] ?? 0;
            $lastWeek[] = $lastWeekData[$day] ?? 0;
        }
        $thisWeekTotal = array_sum($thisWeek);
        $lastWeekTotal = array_sum($lastWeek);
        return view('welcome', compact('totalUsers', 'totalSurahs', 'labels', 'thisWeek', 'lastWeek', 'thisWeekTotal', 'lastWeekTotal'));
    }

}
