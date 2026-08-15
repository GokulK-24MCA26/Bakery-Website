<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .tag-badge { display:inline-block; padding:3px 10px; border-radius:20px; font-size:11.5px; font-weight:600; text-transform:capitalize; }
        .tag-products          { background:#FEF3E2; color:#C98B2E; }
        .tag-events            { background:#E8F5E9; color:#388E3C; }
        .tag-behind-the-scenes { background:#EDE7F6; color:#5E35B1; }
        .tag-seasonal          { background:#FDE8EB; color:#B23A48; }
    </style>
</head>
<body>

@include('layouts.sidebar')

<main class="main">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="page-title">Gallery</h1>
            <p class="page-sub mb-0">Manage photos by tag.</p>
        </div>
        <a href="{{ route('gallery.create') }}" class="btn-primary-admin">
            <i class="fa-solid fa-plus me-1"></i> Add Photo
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
                    <th>Title</th>
                    <th>Tag</th>
                    <th>Order</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $item->image) }}" width="64" height="52"
                             style="border-radius:8px;object-fit:cover;">
                    </td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <span class="tag-badge tag-{{ $item->tag }}">
                            {{ ucwords(str_replace('-', ' ', $item->tag)) }}
                        </span>
                    </td>
                    <td>{{ $item->sort_order }}</td>
                    <td style="font-size:12px;color:#8A7460;">{{ basename($item->image) }}</td>
                    <td>
                        <a href="{{ route('gallery.edit', $item) }}" class="action-btn edit">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('gallery.destroy', $item) }}" style="display:inline"
                              onsubmit="return confirm('Delete this photo?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:#8A7460;padding:32px;">No photos yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
