@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/fc-4.0.2/fh-3.2.2/r-2.2.9/rg-1.1.4/sc-2.0.5/sb-1.3.2/sl-1.3.4/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class='card'>
        <div class='card-body'>
            <a class="btn btn-success" href="{{ route('students.create') }}">
                Thêm
            </a>
            <div class="form-group">
                <select id="select-name"></select>
            </div>
            <table class="table table-striped" id="table-index">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/fc-4.0.2/fh-3.2.2/r-2.2.9/rg-1.1.4/sc-2.0.5/sb-1.3.2/sl-1.3.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {

            var buttonCommon = {
                exportOptions: {
                    columns: ':visible :not(.not-export)'
                }
            };
            let table = $('#table-index').DataTable({
                dom: 'Blrtip',
                select: true,
                buttons: [
                    $.extend( true, {}, buttonCommon, {
                        extend: 'copyHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'csvHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'pdfHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'print'
                    } ),
                    'colvis'
                ],
                lengthMenu: [ 1, 25, 50, 75, 100 ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('students.api') !!}',
                columnDefs: [
                    { className: "not-export", "targets": [ 3 ] }
                ],
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'age', name: 'age' },
                    {
                        data: 'edit',
                        targets: 3,
                        orderable: false,
                        searchable: false,
                        render: function ( data, type, row, meta ) {
                          return `<a class="btn btn-primary" href="${data}">
                                Edit
                            </a>`;
                        }
                    },
                    {
                        data: 'destroy',
                        targets: 4,
                        orderable: false,
                        searchable: false,
                        render: function ( data, type, row, meta ) {
                          return `<form action="${data}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type='button' class="btn-delete btn btn-danger">Delete</button>
                            </form>`;
                        }
                    },
                ]
            });

            $(document).on('click','.btn-delete',function(){
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function() {
                        console.log("success");
                        table.draw();
                    },
                    error: function() {
                        console.log("error");
                    }
                });
            });
        });

    </script>
@endpush