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

            {{-- Stats grid: 3 per row on desktop (balanced 3+3). Using single row with auto-wrap so 6 cards = 2 full rows, no orphan 2. --}}
            <div class="row g-3 align-items-stretch">
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-warning-subtle">
                            <i class="fa-solid fa-tags text-warning"></i>
                        </div>
                        <div>
                            <div class="stat-value">{{ $stats['categories'] ?? '—' }}</div>
                            <div class="stat-label">Categories</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-danger-subtle">
                            <i class="fa-solid fa-bread-slice text-danger"></i>
                        </div>
                        <div>
                            <div class="stat-value">{{ $stats['products'] ?? '—' }}</div>
                            <div class="stat-label">Products</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-success-subtle">
                            <i class="fa-solid fa-bag-shopping text-success"></i>
                        </div>
                        <div>
                            <div class="stat-value">{{ $stats['orders'] ?? '—' }}</div>
                            <div class="stat-label">Orders</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary-subtle">
                            <i class="fa-solid fa-users text-primary"></i>
                        </div>
                        <div>
                            <div class="stat-value">{{ $stats['users'] ?? '—' }}</div>
                            <div class="stat-label">Users</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('admin.contacts.index') }}" class="stat-card-link">
                        <div class="stat-card" style="border-color: {{ ($stats['unread'] ?? 0) > 0 ? '#F0A0A0' : '#EDE3D4' }}; background: {{ ($stats['unread'] ?? 0) > 0 ? '#FFF0F0' : '#fff' }};">
                            <div class="stat-icon" style="background:#FDE8EB;">
                                <i class="fa-solid fa-envelope text-danger"></i>
                            </div>
                            <div>
                                <div class="stat-value" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                                    {{ $stats['contacts'] ?? 0 }}
                                    @if(($stats['unread'] ?? 0) > 0)
                                        <span style="background:#B23A48;color:#fff;font-size:11px;padding:2px 7px;border-radius:20px;white-space:nowrap;">{{ $stats['unread'] }} new</span>
                                    @endif
                                </div>
                                <div class="stat-label">Contact Messages</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('admin.contacts.settings') }}" class="stat-card-link">
                        <div class="stat-card">
                            <div class="stat-icon" style="background:#E8F5E9;">
                                <i class="fa-solid fa-address-book" style="color:#2E7D32;"></i>
                            </div>
                            <div>
                                <div class="stat-value" style="font-size:18px;line-height:1.1;">Contact</div>
                                <div class="stat-label">Edit Details</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>


            {{-- Recent Contact Messages + Contact Details Preview --}}
            <div class="row g-3 mt-4">
                <div class="col-lg-7">
                    <div class="admin-card" style="padding:22px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 style="font-family:'Fraunces',serif;font-size:16px;color:#2C1810;margin:0;">Recent Messages</h3>
                            <a href="{{ route('admin.contacts.index') }}" style="font-size:12.5px;color:#B23A48;text-decoration:none;font-weight:600;">View all →</a>
                        </div>
                        @if(isset($recentContacts) && $recentContacts->count())
                            <div style="display:flex;flex-direction:column;gap:10px;">
                                @foreach($recentContacts as $rc)
                                    <a href="{{ route('admin.contacts.show', $rc) }}" style="display:flex;gap:14px;align-items:center;padding:12px;border:1px solid {{ $rc->is_read ? '#F0E8D8' : '#F0A0A0' }};background:{{ $rc->is_read ? '#fff' : '#FFF8F0' }};border-radius:10px;text-decoration:none;">
                                        <div style="width:38px;height:38px;border-radius:50%;background:{{ $rc->is_read ? '#EDE3D4' : '#B23A48' }};color:{{ $rc->is_read ? '#8A7460' : '#fff' }};display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;flex-shrink:0;">{{ strtoupper(substr($rc->name,0,1)) }}</div>
                                        <div style="flex:1;min-width:0;">
                                            <div style="font-size:13.5px;font-weight:600;color:#2C1810;display:flex;align-items:center;gap:8px;">
                                                {{ $rc->name }}
                                                @if(!$rc->is_read)<span style="background:#B23A48;color:#fff;font-size:10px;padding:2px 6px;border-radius:20px;">NEW</span>@endif
                                                <span style="font-weight:400;color:#8A7460;font-size:11.5px;">— {{ $rc->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div style="font-size:12.5px;color:#8A7460;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $rc->subject ? '['.$rc->subject.'] ' : '' }}{{ \Illuminate\Support\Str::limit($rc->message, 70) }}</div>
                                        </div>
                                        <i class="fa-solid fa-chevron-right" style="color:#B8A489;font-size:11px;"></i>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div style="text-align:center;padding:28px;color:#8A7460;">
                                <i class="fa-solid fa-inbox" style="font-size:20px;display:block;margin-bottom:8px;"></i>
                                No messages yet.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="admin-card" style="padding:22px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 style="font-family:'Fraunces',serif;font-size:16px;color:#2C1810;margin:0;">Live Contact Details</h3>
                            <a href="{{ route('admin.contacts.settings') }}" style="font-size:12.5px;color:#B23A48;text-decoration:none;font-weight:600;">Edit →</a>
                        </div>
                        @if(isset($contactDetail) && $contactDetail)
                            <div style="display:flex;flex-direction:column;gap:12px;font-size:13.5px;line-height:1.6;">
                                <div style="display:flex;gap:12px;align-items:start;">
                                    <span style="width:36px;height:36px;border-radius:8px;background:#FEF3E2;color:#C98B2E;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fa-solid fa-location-dot"></i></span>
                                    <div>
                                        <div style="font-weight:600;color:#2C1810;">{{ $contactDetail->address_line1 }}</div>
                                        <div style="color:#8A7460;">{{ $contactDetail->address_line2 }}</div>
                                    </div>
                                </div>
                                <div style="display:flex;gap:12px;align-items:center;">
                                    <span style="width:36px;height:36px;border-radius:8px;background:#FDE8EB;color:#B23A48;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fa-solid fa-phone"></i></span>
                                    <div>
                                        <a href="tel:{{ $contactDetail->phone_raw }}" style="color:#B23A48;font-weight:600;text-decoration:none;">{{ $contactDetail->phone }}</a>
                                        <span style="color:#8A7460;"> · </span>
                                        <a href="{{ $contactDetail->whatsapp_url }}" target="_blank" style="color:#388E3C;text-decoration:none;">{{ $contactDetail->whatsapp_display }}</a>
                                    </div>
                                </div>
                                @if($contactDetail->email)
                                <div style="display:flex;gap:12px;align-items:center;">
                                    <span style="width:36px;height:36px;border-radius:8px;background:#E3F2FD;color:#1565C0;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fa-solid fa-envelope"></i></span>
                                    <a href="mailto:{{ $contactDetail->email }}" style="color:#3A2519;text-decoration:none;">{{ $contactDetail->email }}</a>
                                </div>
                                @endif
                                <div style="display:flex;gap:12px;align-items:start;">
                                    <span style="width:36px;height:36px;border-radius:8px;background:#E8F5E9;color:#388E3C;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fa-solid fa-clock"></i></span>
                                    <div style="color:#8A7460;">
                                        {{ $contactDetail->hours_weekday }}<br>{{ $contactDetail->hours_sunday }}
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:16px;padding:12px;background:#FBF3E4;border:1px solid #EDE3D4;border-radius:8px;font-size:11.5px;color:#8A7460;">
                                Shown on <a href="{{ route('contact') }}" target="_blank" style="color:#B23A48;">public contact page</a> & footer.
                            </div>
                        @else
                            <div style="color:#8A7460;font-size:13px;">Not configured.</div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
