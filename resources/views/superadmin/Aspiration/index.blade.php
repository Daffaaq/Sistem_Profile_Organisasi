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
            <h6 class="m-0 font-weight-bold text-primary">Aspiration Management</h6>
        </div>
        <div class="card-body">
            <a href="{{ url('/superadmin/Aspiration/create') }}" class="btn btn-success float-right mb-3">
                <i class="fas fa-plus"></i> Aspiration
            </a>
            <a href="{{ url('/superadmin/Aspiration/print_pdf') }}" class="btn btn-info float-right mb-3" target="_blank">
                <i class="fas fa-print"></i> Print PDF
            </a>

            <div class="table-responsive">
                <table class="table table-bordered" id="AspirationTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Aspirasi</th>
                            <th>Deskripsi Aspirasi</th>
                            <th>Tanggal Aspirasi</th>
                            <th>Waktu Aspirasi</th>
                            <th>Status Aspirasi</th>
                            <th>Nama Kategori</th>
                            <th>Update Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusModalLabel">Update Aspiration Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateStatusForm" action="" method="POST">
                    @csrf
                    <!-- Tambahkan _method field untuk menunjukkan bahwa ini adalah metode PUT atau PATCH -->
                    @method('PUT')

                    <div class="modal-body">
                        <p>Are you sure you want to update the status of this aspiration?</p>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Todo">Todo</option>
                                <option value="In progress">In progress</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#AspirationTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/superadmin/Aspiration/data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tittle_aspirations',
                        name: 'tittle_aspirations'
                    },
                    {
                        data: 'description_aspirations',
                        name: 'description_aspirations'
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
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'update_status',
                        name: 'update_status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'edit_delete',
                        name: 'edit_delete',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#AspirationTable').on('click', '.update-status', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var updateUrl = '{{ url('/superadmin/Aspiration/updateStatus') }}/' + id;

                // Tampilkan modal update status
                $('#updateStatusModal').modal('show');

                // Tangkap perubahan status dan kirim permintaan
                $('#updateStatusForm').off('submit').on('submit', function(event) {
                    event.preventDefault();
                    var status = $('#status')
                        .val(); // Ambil nilai status dari elemen select di modal

                    // Kirim permintaan dengan metode PUT
                    fetch(updateUrl, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json', // Atur tipe konten menjadi JSON
                            },
                            body: JSON.stringify({
                                status: status
                            }) // Konversi data ke JSON dan kirim
                        })
                        .then(response => response.json())
                        .then(data => {
                            $('#updateStatusModal').modal(
                                'hide'); // Sembunyikan modal setelah berhasil update
                            location.reload();
                            $('#AspirationTable').DataTable().ajax
                                .reload(); // Reload data tabel setelah berhasil update
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });
            });


            $('#AspirationTable').on('click', 'a.delete-file', function(e) {
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
                            $('#AspirationTable').DataTable().ajax.reload();
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
