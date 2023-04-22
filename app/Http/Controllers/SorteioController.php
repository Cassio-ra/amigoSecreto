<?php

namespace App\Http\Controllers;

use App\Http\Requests\SorteioRequest;
use App\Models\Pessoa;
use App\Models\Sorteio;
use App\Models\SorteioStatus;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SorteioController extends Controller
{
    public function create()
    {
        return view('sorteio.create');
    }

    public function edit(Sorteio $sorteio) {
        confirmDelete('Remover Pessoa!', 'Deseja realmente Remover esta pessoa do sorteio?');

        return view('sorteio.create', compact('sorteio'));
    }

    public function show(Sorteio $sorteio){
        return view('sorteio.show', compact('sorteio'));
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

    public function sortear($sorteio)
    {
        try {
            $sorteio = Sorteio::find($sorteio);
            $pessoas = $sorteio->pessoas->all();

            for ($i = 0; $i <= (count($sorteio->pessoas) - 1) ; $i ++) { 
                $pessoa1 = $sorteio->pessoas[$i];

                $indexP2 = array_rand($pessoas);
                while ($i == $indexP2) {
                    $indexP2 = array_rand($pessoas);
                }
                $pessoa2 = $pessoas[$indexP2];
                unset($pessoas[$indexP2]);

                $pessoa1->update([
                    'sorteado_id' => $pessoa2->id,
                ]);
            }

            // Se houver uma pessoa sobrando, vincula ela com a primeira pessoa da lista
            if (count($pessoas) == 1) {
                $pessoa_sorteada = $pessoas[array_rand($pessoas)];
                $pessoa_sorteada->update([
                    'sorteado_id' => $pessoas[0],
                ]);
            }

            $sorteio->update([
                'status_codigo' => SorteioStatus::SORTEADO,
            ]);

            return true;

        } catch (\Throwable $th) {
            //Tratativas para erro
            return response()->json($th->getMessage());
        }
    }
}
