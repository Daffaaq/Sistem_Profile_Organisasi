@extends('admin.layouts.index')
@section('container')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">File Management</h6>
        </div>
        <div class="card-body">
            <a href="{{ url('/admin/File/create') }}" class="btn btn-success float-right mb-3">
                <i class="fas fa-plus"></i>File
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="FileTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>Waktu Upload</th>
                            <th>Tanggal Upload</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        var fileDetailsUrl = "{{ url('admin/File/data/upload') }}"; // Update the URL
        $(document).ready(function() {
            $('#FileTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/admin/File/data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            var timestamp = new Date().getTime(); // Generate a timestamp
                            return '<a href="' + fileDetailsUrl + '/' + row.id +
                                '?t=' + timestamp + '" target="_blank">' + data + '</a>';
                        }
                    },
                    {
                        data: 'file_time_created',
                        name: 'file_time_created'
                    },
                    {
                        data: 'file_date_created',
                        name: 'file_date_created'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#FileTable').on('click', 'a.delete-file', function(e) {
                e.preventDefault();
                var deleteUrl = $(this).data('url');

                if (confirm('Are you sure?')) {
                    fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            $('#FileTable').DataTable().ajax.reload();
                            location.reload();
                        })
                        .catch(error => {
                            // Handle error
                            console.error(error);
                        });
                }
            });
        });
    </script>
@endsection
