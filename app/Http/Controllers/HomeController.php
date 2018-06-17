<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $contests = Contest::where('active', 1)->with('owner')->with('photo')
            ->orderBy('id', 'desc')
            ->get();

        return view('index', compact('contests'));
    }
}
