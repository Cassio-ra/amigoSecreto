<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use App\Models\Sorteio;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PessoaController extends Controller
{
    public function create($id, Pessoa $pessoa)
    {
        $sorteio = Sorteio::find($id);
        return view('pessoa.create', compact('sorteio', 'pessoa'));
    }

    public function store(PessoaRequest $request)
    {
        try {
            if ($request->get('id')) {
                $pessoa = Pessoa::find($request->get('id'));
                $pessoa->update($request->all());

                $title = 'Participante Atualizado!';
                $message = 'Participante atualizado com Sucesso!';
            }else{
                Pessoa::create($request->all());

                $title = 'Participante Criado!';
                $message = 'Novo participante cadastrado com Sucesso!';
            }

            Alert::success($title, $message)->autoclose(1500);
            return redirect()->route('sorteio.edit', $request->get('sorteio_id'));
        } catch (\Throwable $th) {
            Alert::error('Ooops...', $th->getMessage())->autoclose(1500);
            return redirect()->back();
        }
    }

    public function destroy(Pessoa $pessoa)
    {
        $sorteio = $pessoa->sorteio_id;
        $pessoa->delete();
        return redirect()->route('sorteio.edit', $sorteio);
    }
}
