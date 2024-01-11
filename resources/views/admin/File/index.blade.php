@extends('admin.layouts.index')

@section('container')
    <div class="container mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th>LOGO</th>
                    <th>File Name</th>
                    <th>Tanggal</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- File 1 -->
                <tr>
                    <td>
                        <!-- Icon File (menggunakan kelas text-danger untuk warna merah) -->
                        <i class="fas fa-file-alt fa-2x text-danger"></i>
                    </td>
                    <td class="text-truncate" style="max-width: 150px;">DISEMNASI JTI 2024-2025
                        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
                    <td>{{ date('Y-m-d') }}</td>
                    <td>{{ date('H:i:s') }}</td>
                    <td>
                        <!-- Action Buttons -->
                        <a href="#" class="btn btn-primary btn-sm">Download</a>
                    </td>
                </tr>

                <!-- File 2 -->
                <tr>
                    <td>
                        <!-- Icon File (menggunakan kelas text-success untuk warna hijau) -->
                        <i class="fas fa-file-alt fa-2x text-success"></i>
                    </td>
                    <td class="text-truncate" style="max-width: 150px;">File Name 2</td>
                    <td>{{ date('Y-m-d') }}</td>
                    <td>{{ date('H:i:s') }}</td>
                    <td>
                        <!-- Action Buttons -->
                        <a href="#" class="btn btn-primary btn-sm">Download</a>
                    </td>
                </tr>

                <!-- Tambahkan baris lainnya sesuai kebutuhan -->
            </tbody>
        </table>
    </div>
@endsection
