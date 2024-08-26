<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .table-container {
            max-width: 1200px;
            overflow-x: auto;
        }
    </style>
</head>
<body>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Year</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bigData as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->year }}</td>
                        <td>{{ $data->category_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>

