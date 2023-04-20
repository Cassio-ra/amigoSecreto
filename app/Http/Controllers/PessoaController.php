<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use App\Models\Sorteio;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function create($id, Pessoa $pessoa)
    {
        $sorteio = Sorteio::find($id);
        return view('pessoa.create', compact('sorteio', 'pessoa'));
    }

    public function store(PessoaRequest $request)
    {
        if ($request->get('id')) {
            $pessoa = Pessoa::find($request->get('id'));

            $pessoa->update($request->all());
        }else{
            Pessoa::create($request->all());
        }

        return redirect()->route('sorteio.edit', $request->get('sorteio_id'));
    }

    public function destroy(Pessoa $pessoa)
    {
        dd('excluir');
    }
}
