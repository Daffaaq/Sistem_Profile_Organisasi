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
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $profile->name_profiles }}</h1>
        <p>{{ $profile->address_profiles }}</p>
        <p>{{ $profile->phone_profiles }}</p>
        {{-- <img src="{{ asset($profile->logo_profiles) }}" alt="Logo"> --}}
    </div>

    <h2>List of Aspirations</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Created Date</th>
                <th>Created Time</th>
                <th>Status</th>
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
