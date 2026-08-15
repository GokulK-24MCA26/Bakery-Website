<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500&family=Work+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

    @include('layouts.sidebar')

    <main class="main">
        <div class="mb-4">
            <a href="{{ route('categories.index') }}" style="color:#8A7460;font-size:13px;text-decoration:none;">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Categories
            </a>
            <h1 class="page-title mt-2">Add Category</h1>
        </div>

        <div class="admin-card" style="max-width:480px;">
            @if ($errors->any())
                <div class="alert-error-admin mb-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group p-4">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Cakes"
                        class="{{ $errors->has('name') ? 'invalid' : '' }}">
                </div>

                <div class="form-group p-4">
                    <label>Image <span style="color:#8A7460;font-weight:400;">(optional)</span></label>
                    <input type="file" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn-primary-admin mt-2 m-2" style="width:auto%;">
                    Save Category
                </button>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
