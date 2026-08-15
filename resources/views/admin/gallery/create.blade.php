<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Photo — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .preview-box {
            width:100%; height:180px; border-radius:10px;
            border:2px dashed #E6D8BF; background:#FFFDF9;
            display:flex; flex-direction:column;
            align-items:center; justify-content:center;
            color:#B8A489; font-size:13px; gap:8px;
            overflow:hidden; cursor:pointer;
        }
        .preview-box img { width:100%; height:100%; object-fit:cover; display:none; }
        .preview-box i { font-size:28px; }
    </style>
</head>
<body>

@include('layouts.sidebar')

<main class="main">
    <div class="mb-4">
        <a href="{{ route('gallery.index') }}" style="color:#8A7460;font-size:13px;text-decoration:none;">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Gallery
        </a>
        <h1 class="page-title mt-2">Add Photo</h1>
    </div>

    <div class="admin-card" style="max-width:500px;">
        @if($errors->any())
            <div class="alert-error-admin" style="margin:20px 20px 0;">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data" style="padding:24px;">
            @csrf

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       placeholder="e.g. Fresh Morning Bake"
                       class="{{ $errors->has('title') ? 'invalid' : '' }}">
            </div>

            <div class="form-group">
                <label>Tag</label>
                <select name="tag" class="{{ $errors->has('tag') ? 'invalid' : '' }}"
                        style="width:100%;height:42px;padding:0 13px;border-radius:8px;border:1px solid #E6D8BF;background:#FFFDF9;font-family:'Work Sans',sans-serif;font-size:14px;color:#3A2519;">
                    <option value="">— Select tag —</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag }}" {{ old('tag') == $tag ? 'selected' : '' }}>
                            {{ ucwords(str_replace('-', ' ', $tag)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Sort Order <span style="color:#8A7460;font-weight:400;">(lower = first)</span></label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
            </div>

            <div class="form-group">
                <label>Image</label>
                <div class="preview-box" id="previewBox" onclick="document.getElementById('imageInput').click()">
                    <img id="previewImg" src="" alt="">
                    <i class="fa-solid fa-cloud-arrow-up" id="previewIcon"></i>
                    <span id="previewText">Click to upload image</span>
                </div>
                <input type="file" name="image" id="imageInput" accept="image/*"
                       style="display:none;" class="{{ $errors->has('image') ? 'invalid' : '' }}">
                <small style="color:#8A7460;font-size:11.5px;margin-top:6px;display:block;">
                    Saved as: <em>tagindex + itemindex + title</em> &nbsp;e.g. <strong>0101freshmorningbake.jpg</strong>
                </small>
            </div>

            <button type="submit" class="btn-primary-admin" style="width:100%;">
                <i class="fa-solid fa-floppy-disk me-1"></i> Save Photo
            </button>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('imageInput').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('previewImg');
            img.src = e.target.result;
            img.style.display = 'block';
            document.getElementById('previewIcon').style.display = 'none';
            document.getElementById('previewText').style.display = 'none';
        };
        reader.readAsDataURL(file);
    });
</script>
</body>
</html>
