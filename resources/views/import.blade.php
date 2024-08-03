<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import</title>
</head>
<body>
    <h1>Upload file:</h1>
    <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel_file" accept=".xls, .xlsx">
        <br><br>
        <button type="submit">Upload</button>
    </form>
    <br>
    <a href="{{ route('menu') }}">Back to the menu</a>
</body>
</html>