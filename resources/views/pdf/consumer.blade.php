<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
    td, th {
    border: 1px solid #777;
    padding: 0.5rem;
    text-align: center;
    font-size: 10px
}

table {
    width: 100%;
    border-collapse: collapse;
}

tbody tr:nth-child(odd) {
    background: #eee;
}
caption {
    font-size: 0.2rem;
}
    </style>
</head>
<body>
       <h5>Consumers List</h5>

       <table>
        <thead>
            <tr>
                <th>Sl no.</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Sl no.</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Sl no.</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consumers as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->phone }}</td>
                 <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->phone }}</td>
            </tr>
            @endforeach


        </tbody>
    </table>
</body>
</html>
