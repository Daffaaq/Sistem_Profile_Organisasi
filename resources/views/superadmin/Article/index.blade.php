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
            <h6 class="m-0 font-weight-bold text-primary">Article Management</h6>
        </div>
        <div class="card-body">
            <a href="{{ url('/superadmin/Article/create') }}" class="btn btn-success float-right mb-3">
                <i class="fas fa-plus"></i> Article
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="ArticleTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Article</th>
                            <th>Title Article</th>
                            <th>Description Article</th>
                            <th>Date Created Article</th>
                            <th>Time Created Article</th>
                            <th>Image Article</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="articleModal" tabindex="-1" role="dialog" aria-labelledby="articleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="articleModalLabel">Article Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="articleDetails">
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
            $('#ArticleTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/superadmin/Article/data') }}',
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
                        data: 'Descriptions',
                        name: 'Descriptions',
                        render: function(data, type, full, meta) {
                            return '<div class="description-cell">' + data + '</div>';
                        }
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
                        data: 'image_path_article',
                        name: 'image_path_article',
                        render: function(data, type, full, meta) {
                            return '<img src="{{ asset('storage/') }}/' + data +
                                '" class="img-thumbnail" style="max-width: 100px;">';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#ArticleTable').on('click', 'a.delete-file', function(e) {
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
                            $('#ArticleTable').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            // Handle error
                            console.error(error);
                        });
                }
            });

            $('#ArticleTable').on('click', 'button.view-article', function(e) {
                e.preventDefault();
                var data = $('#ArticleTable').DataTable().row($(this).closest('tr')).data();
                var articleId = data.id;
                var articleTitle = data.title;
                var articleDescription = data.Descriptions;
                var articleCategory = data.category_name;
                var articleImage = '{{ asset('storage/') }}/' + data.image_path_article;

                var modalContent = '<div class="modal-header">' +
                    '<h5 class="modal-title" id="articleModalLabel">' + articleTitle + '</h5>' +
                    '</div>' +
                    '<div class="modal-body">' +
                    '<p><strong>Description:</strong></p>' +
                    '<p style="text-align: justify;">' + articleDescription + '</p>' +
                    '<p><strong>Category:</strong> ' + articleCategory + '</p>' +
                    '<img src="' + articleImage + '" class="img-fluid" alt="Article Image">' +
                    '</div>';

                $('#articleDetails').html(modalContent);
                $('#articleModal').modal('show');
            });
        });
    </script>
@endsection
