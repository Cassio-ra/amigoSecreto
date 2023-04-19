<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Sorteio;
use Illuminate\Http\Request;

class SorteioController extends Controller
{
    public function index()
    {
        dd('indequis');
    }

    public function create()
    {
        return view('sorteio.create');
    }

    public function store(Request $request)
    {
        if ($request->get('id')) {
            $sorteio = Sorteio::find($request->get('id'));

            $sorteio->update($request->all());
        }else{
            $sorteio = Sorteio::create($request->all());
        }

        return redirect()->route('sorteio.edit', $sorteio->id);
    }

    public function edit(Sorteio $sorteio) {
        return view('sorteio.create', compact('sorteio'));
    }

    public function destroy(Sorteio $sorteio)
    {
        $sorteio->delete();

        return redirect()->route('home');
    }
}
