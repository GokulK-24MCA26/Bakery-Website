<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

@include('layouts.sidebar')

<main class="main">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="page-title">Products</h1>
            <p class="page-sub mb-0">Manage your bakery products.</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn-primary-admin">
            <i class="fa-solid fa-plus me-1"></i> Add Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success-admin">{{ session('success') }}</div>
    @endif

    <div class="admin-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="48" height="48"
                                 style="border-radius:8px;object-fit:cover;">
                        @else
                            <div style="width:48px;height:48px;border-radius:8px;background:#EDE3D4;display:flex;align-items:center;justify-content:center;">
                                <i class="fa-solid fa-image" style="color:#B8A489;"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '—' }}</td>
                    <td>₹{{ number_format($product->price, 2) }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="action-btn edit">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline"
                              onsubmit="return confirm('Delete this product?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:#8A7460;padding:32px;">No products yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
