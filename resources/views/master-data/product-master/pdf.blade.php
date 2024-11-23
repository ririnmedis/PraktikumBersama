<!DOCTYPE html>
<html>
<head>
    <title>Product Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Product Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Unit</th>
                <th>Type</th>
                <th>Information</th>
                <th>Qty</th>
                <th>Producer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->unit }}</td>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->information }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->producer }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
