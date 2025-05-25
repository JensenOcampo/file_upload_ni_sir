<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload</title>
    <style>
        .image-size {
            height: 150px;
            width: 200px;
            border-radius: 15px;
        }

        .button_center {
            align-content: center;
        }

        .images-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .image-item {
            flex: 0 0 calc(14.28% - 10px);
            min-width: 200px;
            text-align: center;
        }

        .image-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 15px;
        }

        .image-item button {
            margin-top: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .image-item button:hover {
            background-color: red;
            color: white;
        }
    </style>
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

    <h2>Uploaded Images</h2>
    <div class="images-container">
        @forelse ($photos as $photo)
            <div class="image-item">
                <form action="{{ route('delete', $photo->id) }}" method="get">
                    @csrf
                    <img src="/image/{{ $photo->image }}" alt="Uploaded Image">
                    <br>
                    <button class="button_center">Delete</button>
                </form>
            </div>
        @empty
            <div style="text-align: center;">
                <p>No images uploaded yet.</p>
            </div>
        @endforelse
    </div>

    <br><br>

    @if ($photos->hasPages())
        @if ($photos->onFirstPage())
            <span class="pagination-link disabled">&laquo; Previous</span>
        @else
            <a href="{{ $photos->previousPageUrl() }}" class="pagination-link">&laquo; Previous</a>
        @endif

        @if ($photos->hasMorePages())
            <a href="{{ $photos->nextPageUrl() }}" class="pagination-link">Next &raquo;</a>
        @else
            <span class="pagination-link disabled">Next &raquo;</span>
        @endif
    @endif
    <br><br>
    <span class="pagination-info">
        Showing {{ $photos->firstItem() ?? 0 }} to {{ $photos->lastItem() ?? 0 }} of {{ $photos->total() }}
        results
    </span>

</body>

</html>
