<?php

namespace App\Http\Controllers;

use App\Ranking;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index(){
        $total = Ranking::count();
        return view('stats.index', compact('total'));
    }
}
