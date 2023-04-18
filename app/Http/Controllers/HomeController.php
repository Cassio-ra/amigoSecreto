<?php

namespace App\Http\Controllers;

use App\Models\Sorteio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $sorteios = Sorteio::get();
        return view('home', compact('sorteios'));
    }
}
