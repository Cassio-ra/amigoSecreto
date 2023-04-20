@extends('app.layout')
@section('title', 'Home')

@section('content')
<span class="col-span-4 col-start-5 font-bold text-center">
    Sorteios
</span>
<a class="col-end-11 col-span-2" href="{{ route('sorteio.create') }}">
    <button class="border w-full h-8 border-green-700 bg-green-400 rounded-lg">Criar Novo Sorteio</button>
</a>
<div class="col-span-8 col-start-3 mt-4">
    <table id="table" class="display w-full">
        <thead>
            <th>Id</th>
            <th>Nome</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($sorteios as $sorteio)
                <tr>
                    <td>{{ $sorteio->id }}</td>
                    <td>{{ $sorteio->name }}</td>
                    <td class="w-1">
                        <div class="flex">
                            <a href="{{ route('sorteio.edit', $sorteio->id) }}" class="w-[3em] border-y-2 border-l-2 border-blue-400 text-blue-400 hover:bg-blue-400 hover:text-white text-center rounded-l-2xl"><i class="fi fi-rr-pencil"></i></a>
                            <a onclick="$('form#form_{{ $sorteio->id }}').submit()" class="w-[3em] border-2 border-red-400 hover:bg-red-400 text-red-400 hover:text-white hover:cursor-pointer text-center rounded-r-2xl"><i class="fi fi-rr-trash"></i></a>
                        </div>
                    </td>
                    <form action="{{ route('sorteio.destroy', $sorteio->id) }}" method="post" id="form_{{ $sorteio->id }}">
                        @method('DELETE')
                        @csrf
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-dataTable.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                columnDefs: [
                    {
                        targets: [2],
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