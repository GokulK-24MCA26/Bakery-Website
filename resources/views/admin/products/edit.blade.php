<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product — {{ config('app.name') }}</title>
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
        <a href="{{ route('products.index') }}" style="color:#8A7460;font-size:13px;text-decoration:none;">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Products
        </a>
        <h1 class="page-title mt-2">Edit Product</h1>
    </div>

    <div class="admin-card" style="max-width:520px;">
        @if($errors->any())
            <div class="alert-error-admin mb-3">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" style="padding:24px;">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Category</label>
                <select name="category_id"
                        style="width:100%;height:42px;padding:0 13px;border-radius:8px;border:1px solid #E6D8BF;background:#FFFDF9;font-family:'Work Sans',sans-serif;font-size:14px;color:#3A2519;">
                    <option value="">— Select category —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3"
                    style="width:100%;padding:10px 13px;border-radius:8px;border:1px solid #E6D8BF;background:#FFFDF9;font-family:'Work Sans',sans-serif;font-size:14px;color:#3A2519;resize:vertical;">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label>Price (₹)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0">
            </div>

            <div class="form-group">
                <label>Image</label>
                @if($product->image)
                    <div style="margin-bottom:8px;">
                        <img src="{{ asset('storage/' . $product->image) }}" width="80" height="80"
                             style="border-radius:8px;object-fit:cover;">
                        <small style="display:block;color:#8A7460;margin-top:4px;font-size:11.5px;">
                            Current: {{ basename($product->image) }}
                        </small>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn-primary-admin" style="width:100%;">
                Update Product
            </button>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
