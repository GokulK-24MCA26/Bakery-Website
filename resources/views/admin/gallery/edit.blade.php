<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Photo — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

@include('layouts.sidebar')

<main class="main">
    <div class="mb-4">
        <a href="{{ route('gallery.index') }}" style="color:#8A7460;font-size:13px;text-decoration:none;">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Gallery
        </a>
        <h1 class="page-title mt-2">Edit Photo</h1>
    </div>

    <div class="admin-card" style="max-width:500px;">
        @if($errors->any())
            <div class="alert-error-admin" style="margin:20px 20px 0;">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('gallery.update', $item) }}" enctype="multipart/form-data" style="padding:24px;">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $item->title) }}">
            </div>

            <div class="form-group">
                <label>Tag</label>
                <select name="tag"
                        style="width:100%;height:42px;padding:0 13px;border-radius:8px;border:1px solid #E6D8BF;background:#FFFDF9;font-family:'Work Sans',sans-serif;font-size:14px;color:#3A2519;">
                    @foreach($tags as $tag)
                        <option value="{{ $tag }}" {{ $item->tag == $tag ? 'selected' : '' }}>
                            {{ ucwords(str_replace('-', ' ', $tag)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0">
            </div>

            <div class="form-group">
                <label>Current Image</label>
                <div style="margin-bottom:10px;">
                    <img src="{{ asset('storage/' . $item->image) }}" width="120" height="90"
                         style="border-radius:8px;object-fit:cover;border:1px solid #EDE3D4;">
                    <small style="display:block;color:#8A7460;margin-top:4px;font-size:11.5px;">
                        {{ basename($item->image) }}
                    </small>
                </div>
                <label>Replace Image <span style="color:#8A7460;font-weight:400;">(optional)</span></label>
                <input type="file" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn-primary-admin" style="width:100%;">
                <i class="fa-solid fa-floppy-disk me-1"></i> Update Photo
            </button>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
