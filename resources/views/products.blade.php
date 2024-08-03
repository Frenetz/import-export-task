<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>External_code</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td><a href="{{ route('product.card', ['id' => $product->id]) }}">{{$product->external_code}}</a></td>
                    <td>{{$product->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('delete.all.products') }}">Delete all products</a>
    <br><br>
    <a href="{{ route('menu') }}">Back to the menu</a>
    <br><br>
</body>
</html>