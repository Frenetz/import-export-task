<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product card</title>
    <style>
        .product-images img {
            display: inline-block;
            width: 200px;
            height: 200px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Product card</h1>
    <table border="1">
        <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <td>External Code</td>
                <td>{{ $product->external_code }}</td>
            </tr>
            <tr>
                <td>Images:</td>
                <td class="product-images">
                    @foreach ($product_images as $product_image)
                        <img src="{{ asset('storage/' . $product_image->path) }}" alt="product_image">
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>Price</td>
                <td>{{ $product->price }}</td>
            </tr>
            <tr>
                <td>Discount</td>
                <td>{{ $product->discount }}</td>
            </tr>
            @foreach ($additional_fields as $additional_field)
                <tr>
                    <td>{{ $additional_field->key }}</td>
                    <td>{{ $additional_field->value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('product.list') }}">Back to the products</a>
</body>
</html>
