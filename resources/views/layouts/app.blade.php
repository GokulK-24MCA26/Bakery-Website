<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="GMS Web Studio Bakery - Fresh cakes, bakery items and snacks in Erode.">

    <title>
        @yield('title', 'GMS Web Studio Bakery')
    </title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Extra Page CSS --}}
    @stack('styles')
</head>

<body>

    {{-- =========================
         SKELETON LOADING OVERLAY
    ========================== --}}
    <div class="skeleton-overlay" id="pageSkeleton" aria-hidden="true">
        <div class="skeleton sk-nav"></div>
        <div class="skeleton sk-hero"></div>
        <div class="sk-grid">
            <div class="skeleton sk-card"></div>
            <div class="skeleton sk-card"></div>
            <div class="skeleton sk-card"></div>
            <div class="skeleton sk-card"></div>
        </div>
    </div>

    {{-- =========================
         NAVBAR
    ========================== --}}
    @include('layouts.navbar')

    {{-- =========================
         PAGE CONTENT
    ========================== --}}
    <main>
        @yield('content')
    </main>


    {{-- =========================
         FOOTER
    ========================== --}}
    @include('layouts.footer')


    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Custom JavaScript --}}
    <script src="{{ asset('js/script.js') }}"></script>

    {{-- Extra Page Scripts --}}
    @stack('scripts')

</body>

</html>
