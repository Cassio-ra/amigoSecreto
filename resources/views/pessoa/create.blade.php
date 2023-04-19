@extends('app.layout')
@section('title', 'Criar Pessoa')

@section('content')

<div class="col-span-8 col-start-3 border rounded-xl flex grid grid-cols-8">
    <form action="{{ route('pessoa.store') }}" method="post" class="w-full col-span-8 grid grid-cols-8 grid-row-2">
        @csrf
        <div class="ml-2 my-2 col-span-3">
            <label class="block tracking-wide text-gray-700 ml-1" for="name">Nome</label>
            @if (isset($pessoa->id))
                <input id="name" name="name" value="{{ old('name') ?? $pessoa->name }}" placeholder="Insira o Nome do Sorteio" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-2 px-4 mb-1 leading-tight focus:outline-none focus:bg-white">
            @else
                <input id="name" name="name" value="{{ old('name') }}" placeholder="Insira o Nome do Sorteio" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-2 px-4 mb-1 leading-tight focus:outline-none focus:bg-white">
            @endif
            @if ($errors->has('name'))
                <p class="text-red-500 text-xs italic"></p>
            @endif
        </div>
        <div class="ml-2 my-2 col-span-3">
            <label class="block tracking-wide text-gray-700 ml-1" for="email">Email</label>
            @if (isset($pessoa->id))
                <input id="email" name="email" value="{{ old('email') ?? $pessoa->email }}" placeholder="Insira o Email do participante" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-2 px-4 mb-1 leading-tight focus:outline-none focus:bg-white">
            @else
                <input id="email" name="email" value="{{ old('email') }}" placeholder="Insira o Email do participante" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-2 px-4 mb-1 leading-tight focus:outline-none focus:bg-white">
            @endif
            @if ($errors->has('email'))
                <p class="text-red-500 text-xs italic"></p>
            @endif
        </div>
        @if (isset($pessoa->id))
            <input type="hidden" name="id" value="{{ $pessoa->id }}">
        @endif
        <input type="hidden" name="sorteio_id" value="{{ $sorteio->id }}">
        <div class="col-span-2 col-end-9 mr-2 mb-2 row-start-2">
            <button class="border border-green-700 bg-green-500 rounded-lg w-full">Salvar</button>
        </div>
    </form>
</div>
@endsection