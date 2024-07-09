<!-- resources/views/upload.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Upload Questions and Answers</title>
</head>
<body>
    <form action="{{ route('upload.excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="questions">Upload Questions:</label>
            <input type="file" name="questions" required>
        </div>
        <div>
            <label for="answers">Upload Answers:</label>
            <input type="file" name="answers" required>
        </div>
        <button type="submit">Upload</button>
    </form>
</body>
</html>