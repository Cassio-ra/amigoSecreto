<?php

namespace App\Http\Controllers;

use App\Http\Requests\SorteioRequest;
use App\Models\Pessoa;
use App\Models\Sorteio;
use App\Models\SorteioStatus;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function edit(Sorteio $sorteio) {
        confirmDelete('Remover Pessoa!', 'Deseja realmente Remover esta pessoa do sorteio?');
        return view('sorteio.create', compact('sorteio'));
    }

    public function store(SorteioRequest $request)
    {
        try {
            if ($request->get('id')) {
                $sorteio = Sorteio::find($request->get('id'));

                $sorteio->update($request->all());

                $title = 'Sorteio Criado!';
                $message = 'Novo sorteio cadastrado com Sucesso!';
            }else{
                $request->request->add(['status_codigo' => SorteioStatus::AGUARDANDO_SORTEIO]);
                $sorteio = Sorteio::create($request->all());

                $title = 'Sorteio Criado!';
                $message = 'Novo sorteio cadastrado com Sucesso!';
            }

            Alert::success($title, $message)->autoclose(1500);
            return redirect()->route('sorteio.edit', $sorteio->id);
        } catch (\Throwable $th) {
            Alert::error('Ooops...', $th->getMessage())->autoclose(1500);
            return redirect()->back();
        }
    }

    public function destroy(Sorteio $sorteio)
    {
        $sorteio->pessoas()->delete();
        $sorteio->delete();

        return redirect()->route('home');
    }
}
