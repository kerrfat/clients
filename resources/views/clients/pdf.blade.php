<!DOCTYPE html>
<html>
<head>
    <title>Clients List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
            text-align: left;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Clients List</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $index => $client)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->company }}</td>
                    <td>{{ $client->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <strong>Total Clients:</strong> {{ count($clients) }}
    </div>
</body>
</html>
