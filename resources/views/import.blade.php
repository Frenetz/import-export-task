<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Upload file:</h1>
        <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="excel_file">Choose file:</label>
                <input type="file" class="form-control-file" id="excel_file" name="excel_file" accept=".xls, .xlsx">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        <br>
        <a href="{{ route('menu') }}" class="btn btn-secondary">Back to the menu</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Upload file:</h1>
        <form id="importForm" action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="excel_file">Choose file:</label>
                <input type="file" class="form-control-file" id="excel_file" name="excel_file" accept=".xls, .xlsx">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        <br>
        <a href="{{ route('menu') }}" class="btn btn-secondary">Back to the menu</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="waitModal" tabindex="-1" aria-labelledby="waitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="waitModalLabel">Please wait</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data is being parsed. Please wait...
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#importForm').on('submit', function() {
                $('#waitModal').modal('show');
            });
        });
    </script>
</body>
</html>
