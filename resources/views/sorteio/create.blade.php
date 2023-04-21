@extends('app.layout')
@section('title', 'Home')

@section('content')
<div class="col-span-8 col-start-3 border rounded-xl flex grid grid-cols-8">
    <form action="{{ route('sorteio.store') }}" method="post" class="w-full col-span-8 grid grid-cols-8 grid-row-2">
        @csrf
        <div class="ml-2 my-2 col-span-3">
            <label class="block tracking-wide text-gray-700 ml-1" for="name">Nome</label>
            @if (isset($sorteio->id))
                <input id="name" name="name" value="{{ old('name') ?? $sorteio->name }}" placeholder="Insira o Nome do Sorteio" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-2 px-4 mb-1 leading-tight focus:outline-none focus:bg-white">
            @else
                <input id="name" name="name" required value="{{ old('name') }}" placeholder="Insira o Nome do Sorteio" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-300 rounded py-2 px-4 mb-1 leading-tight focus:outline-none focus:bg-white">
            @endif
            @if ($errors->has('name'))
                <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
            @endif
        </div>
        @if (isset($sorteio->id))
            <input type="hidden" name="id" value="{{ $sorteio->id }}">
        @endif
        <div class="col-span-2 col-end-9 mr-2 mb-2 row-start-2">
            <button class="border border-green-700 bg-green-500 rounded-lg w-full">Salvar</button>
        </div>
    </form>
</div>
@if (isset($sorteio->id))
    <a class="col-end-11 col-span-2" href="{{ route('pessoa.add', $sorteio->id) }}">
        <button class="border w-full h-8 border-green-700 bg-green-400 rounded-lg mt-10">Adicionar Participante</button>
    </a>
    <div class="col-span-10 col-start-2 mt-6">
        <table id="table" class="display w-full">
            <thead>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($sorteio->pessoas as $pessoa)
                    <tr>
                        <td>{{ $pessoa->id }}</td>
                        <td>{{ $pessoa->name }}</td>
                        <td>{{ $pessoa->email }}</td>
                        <td class="w-1">
                            <div class="flex">
                                <a href="{{ route('pessoa.add', [$sorteio->id, $pessoa->id]) }}" class="w-[3em] border-y-2 border-l-2 border-blue-400 text-blue-400 hover:bg-blue-400 hover:text-white text-center rounded-l-2xl"><i class="fi fi-rr-pencil"></i></a>
                                <a href="{{ route('pessoa.destroy', $pessoa->id) }}" data-confirm-delete="true" class="w-[3em] border-2 border-red-400 hover:bg-red-400 text-red-400 hover:text-white hover:cursor-pointer text-center rounded-r-2xl"><i class="fi fi-rr-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-dataTable.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                columnDefs: [
                    {
                        targets: [3],
                        orderable: false
                    }
                ]
            });
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTable.min.css') }}">
@endpush