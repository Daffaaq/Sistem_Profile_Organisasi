@extends('superadmin.layouts.index')
@section('container')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Category Article Management</h6>
        </div>
        <div class="card-body">
            <a href="{{ url('/superadmin/categoryArticle/create') }}" class="btn btn-success float-right mb-3">
                <i class="fas fa-plus"></i> Category Article
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="categoryArticleTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
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
        $(document).ready(function() {
            $('#categoryArticleTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/superadmin/categoryArticle/data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name_category_article',
                        name: 'name_category_article'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#categoryArticleTable').on('click', 'a.delete-category', function(e) {
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
                            // Handle success, e.g., reload the DataTable
                            $('#categoryArticleTable').DataTable().ajax.reload();
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
