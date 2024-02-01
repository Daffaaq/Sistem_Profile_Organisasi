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
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users Management</h6>
        </div>
        <div class="card-body">
            {{-- <a href="{{ url('/superadmin/Profile/create') }}" class="btn btn-success float-right mb-3">
                <i class="fas fa-plus"></i> Create Profiles
            </a> --}}
            {{-- <a href="{{ $disableCreateButton ? '#' : url('/superadmin/Profile/create') }}"
                class="btn {{ $disableCreateButton ? 'btn-secondary float-right mb-3 disabled' : 'btn-success float-right mb-3' }}">Tambah
            </a> --}}
            <a href="{{ url('/superadmin/Profile/create') }}" class="btn btn-success float-right mb-3">
                <i class="fas fa-plus"></i> Create Profiles
            </a>
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="profileTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
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
    @include('superadmin.Profiles.modal_error')
    <script>
        $(document).ready(function() {
            $('#profileTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/superadmin/Profile/data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name_profiles',
                        name: 'name_profiles'
                    },
                    {
                        data: 'address_profiles',
                        name: 'address_profiles'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('a.btn.btn-success.float-right.mb-3').click(function(event) {
                // Ambil jumlah data profil dari tabel
                var profileCount = $('#profileTable').DataTable().rows().count();

                // Jika jumlah data profil lebih dari 0, tampilkan modal error
                if (profileCount > 0) {
                    event.preventDefault();
                    $('#addProfileModal').modal('show');
                }
            });


            $('#profileTable').on('click', 'a.delete-Profile', function(e) {
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
                            if (data.warning) {
                                alert(data.warning);
                            } else {
                                // Handle success, e.g., reload the DataTable
                                $('#profileTable').DataTable().ajax.reload();
                                location.reload();
                            }
                        })
                        .catch(error => {
                            // Handle error
                            console.error(error);
                        });
                }
            });

            $('#profileTable').on('click', 'a.view-profiles', function(e) {
                e.preventDefault();
                var data = $('#profileTable').DataTable().row($(this).closest('tr')).data();
                var profilesId = data.id;
                var profilesname = data.name_profiles;
                var profilesaddres = data.address_profiles;
                var profilesDescription = data.description_profiles;
                var profilesphone = data.phone_profiles;
                var profilesemail = data.email_profiles;
                var profilesImage = '{{ asset('storage/') }}/' + data.logo_profiles;

                var modalContent = '<div class="modal-header">' +
                    '<h5 class="modal-title" id="articleModalLabel">' + profilesname + '</h5>' +
                    '</div>' +
                    '<div class="modal-body">' +
                    '<p><strong>Address:</strong> ' + profilesaddres + '</p>' +
                    '<p><strong>Phone:</strong> ' + profilesphone + '</p>' +
                    '<p><strong>Email:</strong> ' + profilesemail + '</p>' +
                    '<p><strong>Description:</strong></p>' +
                    '<p style="text-align: justify;">' + profilesDescription + '</p>' +
                    '<img src="' + profilesImage + '" class="img-fluid" alt="Profile Image">' +
                    '</div>';

                $('#articleDetails').html(modalContent);
                $('#articleModal').modal('show');

            });
        });
    </script>
@endsection
