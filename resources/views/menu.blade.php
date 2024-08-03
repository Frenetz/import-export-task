<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
    <h1>Menu</h1>
    @if (session()->has("success"))
        <div>
            {{session("success")}}
            <br><br>
        </div>
    @elseif (session()->has("error"))
        <div>
            {{session("error")}}
            <br><br>
        </div>
    @endif
    @if ($is_imported === false)
        <a href="{{ route('import.form') }}">Import</a>
        <br><br>
    @else 
        <a href="{{ route('product.list') }}">Products</a>
    @endif
</body>
</html>