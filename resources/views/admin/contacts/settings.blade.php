<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .preview-card { background:#FFF8F0;border:1px solid #F0E4CC;border-radius:12px;padding:18px; }
        .preview-label { font-size:11px;font-weight:600;color:#B8A489;text-transform:uppercase;letter-spacing:0.6px;margin-bottom:6px; }
        .preview-value { font-size:14px;color:#2C1810; }
    </style>
</head>
<body>

@include('layouts.sidebar')

<main class="main">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h1 class="page-title">Contact Details</h1>
            <p class="page-sub mb-0">Edit what customers see on the <a href="{{ route('contact') }}" target="_blank" style="color:#B23A48;">public contact page</a> & footer.</p>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="btn-primary-admin" style="background:#fff;color:#3A2519;border:1px solid #EDE3D4;">
            <i class="fa-solid fa-inbox me-1"></i> View Messages
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success-admin">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error-admin mb-3">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card" style="padding:28px;">
                <form method="POST" action="{{ route('admin.contacts.settings.update') }}">
                    @csrf @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address Line 1</label>
                                <input type="text" name="address_line1" value="{{ old('address_line1', $detail->address_line1) }}" placeholder="GMS Web Studio Bakery,">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address Line 2</label>
                                <input type="text" name="address_line2" value="{{ old('address_line2', $detail->address_line2) }}" placeholder="Erode, Tamil Nadu">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone (display)</label>
                                <input type="text" name="phone" value="{{ old('phone', $detail->phone) }}" placeholder="+91 xxxxx xxxxx">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone (for tel: link, digits only)</label>
                                <input type="text" name="phone_raw" value="{{ old('phone_raw', $detail->phone_raw) }}" placeholder="+91xxxxxxxxxx">
                                <small style="color:#8A7460;font-size:11px;">e.g. +919876543210 — used in href="tel:..."</small>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="form-group">
                                <label>WhatsApp Link (URL)</label>
                                <input type="text" name="whatsapp_url" value="{{ old('whatsapp_url', $detail->whatsapp_url) }}" placeholder="https://wa.me/91xxxxxxxxxx">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>WhatsApp Button Text</label>
                                <input type="text" name="whatsapp_display" value="{{ old('whatsapp_display', $detail->whatsapp_display) }}" placeholder="WhatsApp Us">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Email <span style="color:#8A7460;font-weight:400;">(optional)</span></label>
                                <input type="text" name="email" value="{{ old('email', $detail->email) }}" placeholder="hello@gmsbakery.com">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hours — Weekdays</label>
                                <input type="text" name="hours_weekday" value="{{ old('hours_weekday', $detail->hours_weekday) }}" placeholder="Mon – Sat: 7:00 AM – 9:00 PM">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hours — Sunday</label>
                                <input type="text" name="hours_sunday" value="{{ old('hours_sunday', $detail->hours_sunday) }}" placeholder="Sunday: 8:00 AM – 6:00 PM">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Map Embed URL <span style="color:#8A7460;font-weight:400;">(Google Maps iframe src)</span></label>
                                <textarea name="map_embed_url" rows="3" placeholder="https://www.google.com/maps/embed?pb=..." style="width:100%;padding:11px 13px;border-radius:8px;border:1px solid #E6D8BF;background:#FFFDF9;font-family:'Work Sans',sans-serif;font-size:13px;color:#3A2519;resize:vertical;">{{ old('map_embed_url', $detail->map_embed_url) }}</textarea>
                                <small style="color:#8A7460;font-size:11px;">Paste the <code>src</code> from Google Maps → Share → Embed a map. Leave empty to hide map.</small>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn-primary-admin" style="width:100%;justify-content:center;padding:12px;">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Save Contact Details
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card" style="padding:20px;">
                <h3 style="font-family:'Fraunces',serif;font-size:15px;color:#2C1810;margin-bottom:14px;">Live Preview</h3>
                <div class="preview-card mb-3">
                    <div class="preview-label">Visit Us</div>
                    <div class="preview-value">{{ $detail->address_line1 }}<br>{{ $detail->address_line2 }}</div>
                </div>
                <div class="preview-card mb-3">
                    <div class="preview-label">Call Us</div>
                    <div class="preview-value">
                        <a href="tel:{{ $detail->phone_raw }}" style="color:#B23A48;">{{ $detail->phone }}</a><br>
                        <a href="{{ $detail->whatsapp_url }}" target="_blank" style="color:#388E3C;">{{ $detail->whatsapp_display }}</a>
                    </div>
                </div>
                <div class="preview-card mb-3">
                    <div class="preview-label">Email</div>
                    <div class="preview-value">{{ $detail->email ?: '—' }}</div>
                </div>
                <div class="preview-card">
                    <div class="preview-label">Opening Hours</div>
                    <div class="preview-value">{{ $detail->hours_weekday }}<br>{{ $detail->hours_sunday }}</div>
                </div>
                <p style="font-size:11.5px;color:#8A7460;margin-top:12px;">Preview updates after you save.</p>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
