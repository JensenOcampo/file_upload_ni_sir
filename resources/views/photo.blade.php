<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload</title>
</head>

<body>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h2>Single Image Upload</h2>
    <form action="{{ route('photos.store.single') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        @error('image')
            <span style="color:red;">{{ $message }}</span>
        @enderror
        <button>Upload</button>
    </form>

    <h2>Multiple Image Upload</h2>
    <form action="{{ route('photos.store.multiple') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="images[]" multiple>
        <button>Upload</button>
    </form>

</body>

</html>
