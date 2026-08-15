<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories — {{ config('app.name') }}</title>
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
            <h1 class="page-title">Categories</h1>
            <p class="page-sub mb-0">Manage your product categories.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn-primary-admin">
            <i class="fa-solid fa-plus me-1"></i> Add Category
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
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" width="48" height="48"
                                 style="border-radius:8px;object-fit:cover;">
                        @else
                            <div style="width:48px;height:48px;border-radius:8px;background:#EDE3D4;display:flex;align-items:center;justify-content:center;">
                                <i class="fa-solid fa-image" style="color:#B8A489;"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="action-btn edit">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display:inline"
                              onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:#8A7460;padding:32px;">No categories yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
