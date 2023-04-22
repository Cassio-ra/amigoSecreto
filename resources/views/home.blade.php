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
            <th>Status</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($sorteios as $sorteio)
                <tr>
                    <td>{{ $sorteio->id }}</td>
                    <td>{{ $sorteio->name }}</td>
                    <td>{{ $sorteio->status->desc }}</td>
                    <td class="w-1">
                        <div class="flex">
                            @if ($sorteio->status_codigo == \App\Models\SorteioStatus::AGUARDANDO_SORTEIO)
                                <button onclick="shuffleSorteio({{ $sorteio->id }})" class="w-[3em] border-y-2 border-l-2 border-orange-400 text-orange-400 hover:bg-orange-400 hover:text-white text-center rounded-l-2xl"><i class="fi fi-rr-shuffle"></i></button>
                                <a href="{{ route('sorteio.edit', $sorteio->id) }}" class="w-[3em] border-y-2 border-l-2 border-blue-400 text-blue-400 hover:bg-blue-400 hover:text-white text-center"><i class="fi fi-rr-pencil"></i></a>
                                <a href="{{ route('sorteio.destroy', $sorteio->id) }}" data-confirm-delete="true" class="w-[3em] border-2 border-red-400 hover:bg-red-400 text-red-400 hover:text-white hover:cursor-pointer text-center rounded-r-2xl"><i class="fi fi-rr-trash"></i></a>
                            @else
                                <a href="{{ route('sorteio.show', $sorteio->id) }}" class="w-[3em] border-2 border-green-400 hover:bg-green-400 mx-auto text-green-400 hover:text-white hover:cursor-pointer text-center rounded-2xl"><i class="fi fi-rr-eye"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-dataTable.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                columnDefs: [
                    {
                        targets: [3],
                        orderable: false
                    }
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script>
        function shuffleSorteio(id){
            
            let url = "{{ route('sorteio.sortear', ':id') }}";
            url = url.replace(':id', id);
            $.post(url,
                {
                    _token: "{{ csrf_token() }}",
                },
                function(data, status){
                    let url = "{{ route('sorteio.show', ':id') }}";
                    url = url.replace(':id', id);
                    if (status = 200) {
                        window.location.replace(url)
                    }
                }
            );
        }
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTable.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
@endpush