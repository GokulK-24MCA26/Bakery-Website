@extends('layouts.app')

@section('title', 'Contact Us — ' . config('app.name'))

@push('styles')
<style>
    /* ── Hero ── */
    .contact-hero {
        background: linear-gradient(135deg, #2B1B14 0%, #4a2c1a 100%);
        padding: 80px 0 60px;
        text-align: center;
    }

    .contact-hero h1 {
        font-family: 'Fraunces', serif;
        font-size: 46px; font-weight: 500;
        color: #F6E9D3; margin-bottom: 14px;
    }

    .contact-hero p {
        color: #B8A489; font-size: 16px;
        max-width: 480px; margin: 0 auto;
    }

    /* ── Main section ── */
    .contact-section { padding: 80px 0; background: #FBF3E4; }

    /* ── Info cards ── */
    .info-card {
        background: #fff;
        border-radius: 14px;
        padding: 28px 24px;
        border: 1px solid #EDE3D4;
        display: flex; align-items: flex-start; gap: 16px;
        height: 100%;
    }

    .info-icon {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px; flex-shrink: 0;
    }

    .info-title {
        font-family: 'Fraunces', serif;
        font-size: 16px; font-weight: 500;
        color: #2C1810; margin-bottom: 4px;
    }

    .info-text { color: #8A7460; font-size: 14px; line-height: 1.6; }
    .info-text a { color: #8A7460; text-decoration: none; }
    .info-text a:hover { color: #B23A48; }

    /* ── Form ── */
    .contact-form-card {
        background: #fff;
        border-radius: 16px;
        padding: 36px 32px;
        border: 1px solid #EDE3D4;
        box-shadow: 0 8px 32px rgba(44,24,16,0.07);
    }

    .form-heading {
        font-family: 'Fraunces', serif;
        font-size: 26px; font-weight: 500;
        color: #2C1810; margin-bottom: 6px;
    }

    .form-sub { color: #8A7460; font-size: 14px; margin-bottom: 28px; }

    .cf-group { margin-bottom: 18px; }

    .cf-group label {
        display: block; font-size: 12.5px;
        font-weight: 600; color: #3A2519; margin-bottom: 6px;
    }

    .cf-group input,
    .cf-group textarea,
    .cf-group select {
        width: 100%; padding: 11px 14px;
        border-radius: 8px; border: 1px solid #E6D8BF;
        background: #FFFDF9;
        font-family: 'Work Sans', sans-serif;
        font-size: 14px; color: #3A2519;
        transition: border-color .15s, box-shadow .15s;
    }

    .cf-group input::placeholder,
    .cf-group textarea::placeholder { color: #B7A88C; }

    .cf-group input:focus,
    .cf-group textarea:focus,
    .cf-group select:focus {
        outline: none;
        border-color: #B23A48;
        box-shadow: 0 0 0 3px rgba(178,58,72,0.12);
    }

    .cf-group textarea { resize: vertical; min-height: 120px; }

    .btn-send {
        width: 100%; padding: 12px;
        background: #B23A48; color: #fff;
        border: none; border-radius: 8px;
        font-family: 'Work Sans', sans-serif;
        font-size: 15px; font-weight: 600;
        cursor: pointer; transition: background .15s;
    }

    .btn-send:hover { background: #98303D; }

    .alert-sent {
        background: #E8F5E9; color: #2E7D32;
        border: 1px solid #A5D6A7;
        border-radius: 8px; padding: 12px 16px;
        font-size: 13.5px; margin-bottom: 20px;
    }

    /* ── Map placeholder ── */
    .map-section { padding: 0 0 80px; background: #FBF3E4; }

    .map-placeholder {
        border-radius: 16px;
        background: linear-gradient(135deg, #2B1B14, #4a2c1a);
        height: 280px;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        color: #B8A489; gap: 10px;
    }

    .map-placeholder i { font-size: 36px; color: #F4C430; }
    .map-placeholder span { font-size: 14px; }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="contact-hero">
    <div class="container">
        <h1>Get in Touch</h1>
        <p>We'd love to hear from you — orders, custom cakes, or just to say hello!</p>
    </div>
</section>

{{-- Main --}}
<section class="contact-section">
    <div class="container">
        <div class="row g-4">

            {{-- Left: Info + Form --}}
            <div class="col-lg-5">
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="info-card">
                            <div class="info-icon" style="background:#FEF3E2;color:#C98B2E;">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <div class="info-title">Visit Us</div>
                                <div class="info-text">
                                    {{ config('app.name') }},<br>
                                    Sathyamangalam, Tamil Nadu
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-card">
                            <div class="info-icon" style="background:#FDE8EB;color:#B23A48;">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <div class="info-title">Call Us</div>
                                <div class="info-text">
                                    <a href="tel:+91XXXXXXXXXX">+91 XXXXX XXXXX</a><br>
                                    <a href="#">WhatsApp Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="info-card">
                            <div class="info-icon" style="background:#E8F5E9;color:#388E3C;">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <div class="info-title">Opening Hours</div>
                                <div class="info-text">
                                    Mon – Sat: 7:00 AM – 9:00 PM<br>
                                    Sunday: 8:00 AM – 6:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Form --}}
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h2 class="form-heading">Send a Message</h2>
                    <p class="form-sub">Fill in the form and we'll get back to you shortly.</p>

                    @if(session('sent'))
                        <div class="alert-sent">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            Thank you! Your message has been sent. We'll be in touch soon.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="cf-group">
                                    <label>Your Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                           placeholder="Full name" required>
                                    @error('name')<small style="color:#B23A48;">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="cf-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                           placeholder="you@example.com" required>
                                    @error('email')<small style="color:#B23A48;">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="cf-group">
                                    <label>Phone <span style="color:#8A7460;font-weight:400;">(optional)</span></label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}"
                                           placeholder="+91 XXXXX XXXXX">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="cf-group">
                                    <label>Subject</label>
                                    <select name="subject">
                                        <option value="">— Select —</option>
                                        <option value="order" {{ old('subject')=='order' ? 'selected':'' }}>Place an Order</option>
                                        <option value="custom" {{ old('subject')=='custom' ? 'selected':'' }}>Custom Cake</option>
                                        <option value="feedback" {{ old('subject')=='feedback' ? 'selected':'' }}>Feedback</option>
                                        <option value="other" {{ old('subject')=='other' ? 'selected':'' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="cf-group">
                                    <label>Message</label>
                                    <textarea name="message" placeholder="Tell us what you need...">{{ old('message') }}</textarea>
                                    @error('message')<small style="color:#B23A48;">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-send">
                                    <i class="fa-solid fa-paper-plane me-2"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Map --}}
<section class="map-section">
    <div class="container">
        <div class="map-placeholder">
            <i class="fa-solid fa-map-location-dot"></i>
            <span>Sathyamangalam, Tamil Nadu</span>
            <small style="font-size:12px;color:#8A7460;">Embed Google Map here</small>
        </div>
    </div>
</section>

@endsection
