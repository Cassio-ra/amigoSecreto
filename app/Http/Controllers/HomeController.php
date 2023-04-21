<?php

namespace App\Http\Controllers;

use App\Models\Sorteio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index() 
    {
        $sorteios = Sorteio::get();
        confirmDelete('Excluir Sorteio!', 'Deseja realmente Excluir o sorteio?');
        return view('home', compact('sorteios'));
    }
}
