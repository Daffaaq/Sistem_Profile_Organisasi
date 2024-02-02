@extends('superadmin.layouts.index')
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
            <h6 class="m-0 font-weight-bold text-primary">Galery Management</h6>
        </div>
        <div class="card-body">
            <a href="{{ url('/superadmin/Galery/create') }}" class="btn btn-success float-right mb-3">
                <i class="fas fa-plus"></i> Galery
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="GaleryTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Galery</th>
                            <th>Title Galery</th>
                            <th>Date Created Galery</th>
                            <th>Time Created Galery</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="GaleryModal" tabindex="-1" role="dialog" aria-labelledby="GaleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="GaleryModalLabel">Galery Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="GaleryDetails">
                        <!-- Artikel detail akan dimuat di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .description-cell {
            max-width: 200px;
            /* Sesuaikan lebar maksimum sesuai kebutuhan */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#GaleryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/superadmin/Galery/data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'created_date',
                        name: 'created_date'
                    },
                    {
                        data: 'created_time',
                        name: 'created_time'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#GaleryTable').on('click', 'a.delete-galery', function(e) {
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
                            $('#GaleryTable').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            // Handle error
                            console.error(error);
                        });
                }
            });

            $('#GaleryTable').on('click', 'button.view-galery', function(e) {
                e.preventDefault();
                var data = $('#GaleryTable').DataTable().row($(this).closest('tr')).data();
                var galeryId = data.id;
                var galeryTitle = data.title;
                var galeryCategory = data.category_name;
                var galeryImage = '{{ asset('storage/') }}/' + data.image_path_galeries;

                var modalContent = '<div class="modal-header">' +
                    '<h5 class="modal-title" id="GaleryModalLabel">' + galeryTitle + '</h5>' +
                    '</div>' +
                    '<div class="modal-body">' +
                    '<p><strong>Category:</strong> ' + galeryCategory + '</p>' +
                    '<img src="' + galeryImage + '" class="img-fluid" alt="Galery Image">' +
                    '</div>';

                $('#GaleryDetails').html(modalContent);
                $('#GaleryModal').modal('show');
            });
        });
    </script>
@endsection
