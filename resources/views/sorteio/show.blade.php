@extends('app.layout')
@section('title', 'Home')

@section('content')
<div class="col-span-4 col-start-5 border rounded-xl text-center">
        <h2 class="p-2">{{ $sorteio->name }}</h2>
</div>
<button onclick="shuffleSorteio({{ $sorteio->id }})" class="w-[3em] h-8 my-auto ml-2 border-2 border-orange-400 text-orange-400 hover:bg-orange-400 hover:text-white text-center rounded-2xl"><i class="fi fi-rr-shuffle"></i></button>
<div class="col-span-10 col-start-2 mt-6">
    <table id="table" class="display w-full">
        <thead>
            <th>Nome</th>
            <th>Email</th>
            <th>Sorteado</th>
        </thead>
        <tbody>
            @foreach ($sorteio->pessoas as $pessoa)
                <tr>
                    <td>{{ $pessoa->name }}</td>
                    <td>{{ $pessoa->email }}</td>
                    <td class="group"><span class="invisible group-hover:visible">{{ $pessoa->sorteado->name }}</span><div class="float-right"><i class="fi fi-rr-eye"></i></div></td>
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
                        targets: [2],
                        orderable: false,
                        searchable: false
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