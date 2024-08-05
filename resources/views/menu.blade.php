<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Menu</h1>
        @if (session()->has("success"))
            <div class="alert alert-success">
                {{ session("success") }}
            </div>
        @elseif (session()->has("error"))
            <div class="alert alert-danger">
                {{ session("error") }}
            </div>
        @endif
        @if ($is_imported === false)
            <a href="{{ route('import.form') }}" class="btn btn-primary btn-block">Import</a>
            <br><br>
        @else
            <a href="{{ route('product.list') }}" class="btn btn-primary btn-block">Products</a>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
