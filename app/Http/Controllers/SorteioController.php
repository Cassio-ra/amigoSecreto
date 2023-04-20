<?php

namespace App\Http\Controllers;

use App\Http\Requests\SorteioRequest;
use App\Models\Pessoa;
use App\Models\Sorteio;
use App\Models\SorteioStatus;
use Illuminate\Http\Request;

class SorteioController extends Controller
{
    public function index()
    {
        $sorteios = Sorteio::where('status_codigo', SorteioStatus::SORTEADO)->get();
        return view('sorteio.index', compact('sorteios'));
    }

    public function create()
    {
        return view('sorteio.create');
    }

    public function store(SorteioRequest $request)
    {
        if ($request->get('id')) {
            $sorteio = Sorteio::find($request->get('id'));

            $sorteio->update($request->all());
        }else{
            $request->request->add(['status_codigo' => SorteioStatus::AGUARDANDO_SORTEIO]);
            $sorteio = Sorteio::create($request->all());
        }

        return redirect()->route('sorteio.edit', $sorteio->id);
    }

    public function edit(Sorteio $sorteio) {
        return view('sorteio.create', compact('sorteio'));
    }

    public function destroy(Sorteio $sorteio)
    {
        $sorteio->pessoas()->delete();
        $sorteio->delete();

        return redirect()->route('home');
    }
}
