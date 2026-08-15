<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — {{ config('app.name', 'Millhouse Bakery') }}</title>

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

        <div class="container-fluid">

            <h1 class="page-title">Dashboard</h1>
            <p class="page-sub">Welcome back, {{ Auth::user()->name }}.</p>

            <div class="row g-3">

                <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-warning-subtle">
                            <i class="fa-solid fa-tags text-warning"></i>
                        </div>

                        <div>
                            <div class="stat-value">—</div>
                            <div class="stat-label">Categories</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-danger-subtle">
                            <i class="fa-solid fa-bread-slice text-danger"></i>
                        </div>

                        <div>
                            <div class="stat-value">—</div>
                            <div class="stat-label">Products</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-success-subtle">
                            <i class="fa-solid fa-bag-shopping text-success"></i>
                        </div>

                        <div>
                            <div class="stat-value">—</div>
                            <div class="stat-label">Orders</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary-subtle">
                            <i class="fa-solid fa-users text-primary"></i>
                        </div>

                        <div>
                            <div class="stat-value">—</div>
                            <div class="stat-label">Users</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
