<!-- resources/views/parsed_csv.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Parsed CSV</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Parsed CSV Data</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>First Name</th>
                <th>Initial</th>
                <th>Last Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($people as $person)
                <tr>
                    <td>{{ $person['title'] }}</td>
                    <td>{{ $person['first_name'] }}</td>
                    <td>{{ $person['initial'] }}</td>
                    <td>{{ $person['last_name'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <form action="{{ url('/') }}" method="GET">
        <button type="submit">New File</button>
    </form>
</body>
</html>
