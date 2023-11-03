<!DOCTYPE html>
<html>
<head>
    <title>Data Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:700" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto Slab', serif;
            font-weight: 700;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Data Login</h1>
    <table border="1">
        <tr>
            <th>Group</th>
            <th>Name</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Pin</th>
        </tr>
        @foreach ($result as $item)
        <tr>
            <td>{{ $item['group'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['email'] }}</td>
            <td>{{ $item['telephone'] }}</td>
            <td>{{ $item['pin'] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
