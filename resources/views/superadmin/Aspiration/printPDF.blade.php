<!DOCTYPE html>
<html>

<head>
    <title>Aspiration PDF</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan Anda */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #afafaf;
        }
    </style>
</head>

<body>
    <div class="header" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
        <h1>{{ $profile->name_profiles }}</h1>
        <p>{{ $profile->address_profiles }}</p>
        <p>{{ $profile->phone_profiles }}</p>
        {{-- <img src="{{ asset($profile->logo_profiles) }}" alt="Logo"> --}}
    </div>


    <h2>Daftar Aspirasi</h2>
    <table>
        <thead>
            <tr>
                <th>Judul Aspirasi</th>
                <th>Deskripsi Aspirasi</th>
                <th>Kategoru Aspirasi</th>
                <th>Tanggal Aspirasi</th>
                <th>Waktu Aspirasi</th>
                <th>Status Aspirasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aspirations as $aspiration)
                <tr>
                    <td>{{ $aspiration->tittle_aspirations }}</td>
                    <td>{{ $aspiration->description_aspirations }}</td>
                    <td>{{ $aspiration->categoryAspiration->name_category_aspirations }}</td>
                    <td>{{ $aspiration->created_date }}</td>
                    <td>{{ $aspiration->created_time }}</td>
                    <td>{{ $aspiration->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
