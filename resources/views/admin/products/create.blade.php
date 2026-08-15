<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product — {{ config('app.name') }}</title>
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
        <h1 class="page-title mt-2">Add Product</h1>
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

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" style="padding:24px;">
            @csrf

            <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="{{ $errors->has('category_id') ? 'invalid' : '' }}"
                        style="width:100%;height:42px;padding:0 13px;border-radius:8px;border:1px solid #E6D8BF;background:#FFFDF9;font-family:'Work Sans',sans-serif;font-size:14px;color:#3A2519;">
                    <option value="">— Select category —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       placeholder="e.g. Chocolate Cake"
                       class="{{ $errors->has('name') ? 'invalid' : '' }}">
            </div>

            <div class="form-group">
                <label>Description <span style="color:#8A7460;font-weight:400;">(optional)</span></label>
                <textarea name="description" rows="3" placeholder="Short description..."
                    style="width:100%;padding:10px 13px;border-radius:8px;border:1px solid #E6D8BF;background:#FFFDF9;font-family:'Work Sans',sans-serif;font-size:14px;color:#3A2519;resize:vertical;">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Price (₹)</label>
                <input type="number" name="price" value="{{ old('price') }}"
                       placeholder="0.00" step="0.01" min="0"
                       class="{{ $errors->has('price') ? 'invalid' : '' }}">
            </div>

            <div class="form-group">
                <label>Image <span style="color:#8A7460;font-weight:400;">(optional)</span></label>
                <input type="file" name="image" accept="image/*">
                <small style="color:#8A7460;font-size:11.5px;margin-top:4px;display:block;">
                    Saved as: <em>categoryindex + productindex + name</em> (e.g. 0101chocolatecake.jpg)
                </small>
            </div>

            <button type="submit" class="btn-primary-admin" style="width:100%;">
                Save Product
            </button>
        </form>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
