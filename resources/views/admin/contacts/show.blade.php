<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message — {{ config('app.name') }}</title>
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
        <a href="{{ route('admin.contacts.index') }}" style="color:#8A7460;font-size:13px;text-decoration:none;">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Messages
        </a>
        <h1 class="page-title mt-2">Contact Message</h1>
        <p class="page-sub">Received {{ $contact->created_at->format('d M Y, h:i A') }} — {{ $contact->created_at->diffForHumans() }}</p>
    </div>

    @if(session('success'))
        <div class="alert-success-admin">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card" style="padding:28px;">
                <div style="display:flex;justify-content:space-between;align-items:start;gap:16px;margin-bottom:20px;">
                    <div>
                        <div style="font-family:'Fraunces',serif;font-size:22px;color:#2C1810;">{{ $contact->name }}</div>
                        <div style="font-size:13px;color:#8A7460;">
                            <i class="fa-solid fa-envelope me-1"></i> {{ $contact->email }}
                            @if($contact->phone)
                                <span class="ms-2"><i class="fa-solid fa-phone me-1"></i> {{ $contact->phone }}</span>
                            @endif
                        </div>
                    </div>
                    @if($contact->is_read)
                        <span style="background:#E8F5E9;color:#2E7D32;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;">Read</span>
                    @else
                        <span style="background:#FDE8EB;color:#B23A48;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;">Unread</span>
                    @endif
                </div>

                @if($contact->subject)
                    <div style="margin-bottom:16px;">
                        <span style="font-size:12px;font-weight:600;color:#8A7460;text-transform:uppercase;letter-spacing:0.5px;">Subject</span>
                        <div style="margin-top:4px;background:#FBF3E4;border:1px solid #EDE3D4;padding:8px 12px;border-radius:8px;font-size:14px;text-transform:capitalize;">{{ $contact->subject }}</div>
                    </div>
                @endif

                <div>
                    <span style="font-size:12px;font-weight:600;color:#8A7460;text-transform:uppercase;letter-spacing:0.5px;">Message</span>
                    <div style="margin-top:8px;background:#FFFDF9;border:1px solid #E6D8BF;padding:18px;border-radius:10px;font-size:14.5px;line-height:1.7;color:#3A2519;white-space:pre-wrap;">{{ $contact->message }}</div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject ?? 'Your message to '.config('app.name') }}" class="btn-primary-admin">
                        <i class="fa-solid fa-reply me-1"></i> Reply via Email
                    </a>
                    <form method="POST" action="{{ route('admin.contacts.toggleRead', $contact) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn-primary-admin" style="background:#fff;color:#3A2519;border:1px solid #EDE3D4;">
                            <i class="fa-solid {{ $contact->is_read ? 'fa-envelope' : 'fa-envelope-open' }} me-1"></i>
                            {{ $contact->is_read ? 'Mark Unread' : 'Mark Read' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card" style="padding:20px;">
                <h3 style="font-family:'Fraunces',serif;font-size:15px;color:#2C1810;margin-bottom:12px;">Quick Actions</h3>
                <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Delete this message permanently?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-logout" style="color:#B23A48;border-color:rgba(178,58,72,0.3);background:rgba(178,58,72,0.08);">
                        <i class="fa-solid fa-trash me-1"></i> Delete Message
                    </button>
                </form>
                <div style="margin-top:16px;padding-top:16px;border-top:1px solid #F0E8D8;font-size:12.5px;color:#8A7460;line-height:1.6;">
                    <div><strong style="color:#3A2519;">ID:</strong> #{{ $contact->id }}</div>
                    <div><strong style="color:#3A2519;">IP:</strong> —</div>
                    <div><strong style="color:#3A2519;">Received:</strong> {{ $contact->created_at->format('l, d F Y h:i A') }}</div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
