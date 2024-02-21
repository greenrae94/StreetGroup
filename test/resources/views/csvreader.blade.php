<!DOCTYPE html>
<html>

<head>
    <title>Input CSV</title>
</head>

<body>
    <h1>Please Input a CSV File</h1>
    <form action="{{ route('parse.csv') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file">
        <button>Upload</button>
    </form>
</body>

</html>
