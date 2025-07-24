@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.3.2/b-3.2.4/b-colvis-3.2.4/b-html5-3.2.4/b-print-3.2.4/date-1.5.6/fc-5.0.4/fh-4.0.3/r-3.0.5/rg-1.5.2/sc-2.4.3/sb-1.8.3/sl-3.0.1/datatables.min.css"
        rel="stylesheet" integrity="sha384-42430TjKyOPA87+vicdKtfZ85Rbh7Bq8VBfSp040ZtbSaqy+9JZlS5wU0ZHveQqF"
        crossorigin="anonymous">
@endpush
@section('content')
    <div class="card">
        @if ($errors->any())
            <div class="card-header">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="card-body">
            <a href="{{ route('courses.create') }}" class="btn btn-success">
                Add Course
            </a>
            <table class="table table-striped" id="table-index">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"
            integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"
            integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n"
            crossorigin="anonymous"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.3.2/b-3.2.4/b-colvis-3.2.4/b-html5-3.2.4/b-print-3.2.4/date-1.5.6/fc-5.0.4/fh-4.0.3/r-3.0.5/rg-1.5.2/sc-2.4.3/sb-1.8.3/sl-3.0.1/datatables.min.js"
        integrity="sha384-uvQAFKMD9ZdyMnmeLv0J3G6tCRdisqn+sTv9jszBCD3BR0OqOFCKYEZcqxnnLM4Y"
        crossorigin="anonymous"></script>
    <script>
        $(function () {
            let table = $('#table-index').DataTable({
                layout: {
                    topStart: ['buttons','pageLength'],
                    topEnd: 'search',
                    bottomStart: 'info',
                    bottomEnd: 'paging'
                },
                columnDefs: [
                    { className: 'not-export', 'target': [ 3, 4 ]}
                ],
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        }
                    },
                    'colvis'
                ],
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('courses.api') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    {
                        data: 'edit',
                        name: 'edit',
                        target: 3,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<a href="${data}" class="btn btn-primary">
                                Edit
                            </a>`
                        },
                    },
                    {
                        data: 'destroy',
                        name: 'destroy',
                        target: 4,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<form action="${data}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type='button' class="btn-delete btn btn-danger">Delete</button>
                            </form>`
                        },
                    }
                ]
            });
            $(document).on('click', '.btn-delete', function(){
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function() {
                        console.log('success');
                        table.draw();
                    },
                    error: function () {
                        console.log('error')
                    }
                });
            });
        });
    </script>
@endpush
