@extends('layouts.app')

@section('title', 'About Us — ' . config('app.name'))

@push('styles')
<style>
    /* ── Hero ── */
    .about-hero {
        background: linear-gradient(135deg, #2B1B14 0%, #4a2c1a 100%);
        padding: 80px 0 60px;
        text-align: center;
    }

    .about-hero h1 {
        font-family: 'Fraunces', serif;
        font-size: 46px; font-weight: 500;
        color: #F6E9D3; margin-bottom: 14px;
    }

    .about-hero p {
        color: #B8A489; font-size: 16px;
        max-width: 520px; margin: 0 auto;
        line-height: 1.7;
    }

    /* ── Story ── */
    .about-story { padding: 80px 0; background: #FFF8F0; }

    .story-img {
        border-radius: 16px;
        width: 100%; height: 380px;
        object-fit: cover;
        box-shadow: 0 16px 40px rgba(44,24,16,0.15);
    }

    .story-img-placeholder {
        border-radius: 16px;
        width: 100%; height: 380px;
        background: linear-gradient(135deg, #F0E4CC, #E8D5B0);
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        color: #B8A489;
    }

    .story-img-placeholder i { font-size: 48px; margin-bottom: 12px; }

    .story-label {
        font-family: 'Work Sans', sans-serif;
        font-size: 12px; font-weight: 600;
        color: #B23A48; text-transform: uppercase;
        letter-spacing: 1.5px; margin-bottom: 10px;
    }

    .story-heading {
        font-family: 'Fraunces', serif;
        font-size: 34px; font-weight: 500;
        color: #2C1810; margin-bottom: 18px; line-height: 1.2;
    }

    .story-text {
        color: #6B5344; font-size: 15px;
        line-height: 1.8; margin-bottom: 16px;
    }

    /* ── Stats ── */
    .about-stats { background: #2B1B14; padding: 60px 0; }

    .stat-item { text-align: center; }

    .stat-num {
        font-family: 'Fraunces', serif;
        font-size: 48px; font-weight: 500;
        color: #F4C430; line-height: 1;
    }

    .stat-desc {
        color: #B8A489; font-size: 14px;
        margin-top: 6px; text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    /* ── Values ── */
    .about-values { padding: 80px 0; background: #FBF3E4; }

    .section-label {
        font-size: 12px; font-weight: 600;
        color: #B23A48; text-transform: uppercase;
        letter-spacing: 1.5px; text-align: center;
        margin-bottom: 10px;
    }

    .section-heading {
        font-family: 'Fraunces', serif;
        font-size: 34px; font-weight: 500;
        color: #2C1810; text-align: center;
        margin-bottom: 48px;
    }

    .value-card {
        background: #fff;
        border-radius: 14px;
        padding: 32px 24px;
        border: 1px solid #EDE3D4;
        text-align: center;
        height: 100%;
        transition: transform .2s, box-shadow .2s;
    }

    .value-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(44,24,16,0.1);
    }

    .value-icon {
        width: 56px; height: 56px;
        border-radius: 14px;
        background: #FEF3E2;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; color: #C98B2E;
        margin: 0 auto 18px;
    }

    .value-title {
        font-family: 'Fraunces', serif;
        font-size: 18px; font-weight: 500;
        color: #2C1810; margin-bottom: 10px;
    }

    .value-text { color: #8A7460; font-size: 14px; line-height: 1.7; }

    /* ── Team ── */
    .about-team { padding: 80px 0; background: #FFF8F0; }

    .team-card {
        text-align: center;
        padding: 24px 16px;
    }

    .team-avatar {
        width: 90px; height: 90px;
        border-radius: 50%;
        background: linear-gradient(135deg, #8B4513, #B23A48);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Fraunces', serif;
        font-size: 28px; color: #F6E9D3;
        margin: 0 auto 14px;
    }

    .team-name {
        font-family: 'Fraunces', serif;
        font-size: 18px; font-weight: 500; color: #2C1810;
    }

    .team-role { color: #B23A48; font-size: 13px; font-weight: 600; margin-top: 2px; }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="about-hero">
    <div class="container">
        <h1>Our Story</h1>
        <p>Baked with love, served with warmth — every loaf, every cake, every bite tells our story.</p>
    </div>
</section>

{{-- Story --}}
<section class="about-story">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="story-img-placeholder">
                    <i class="fa-solid fa-bread-slice"></i>
                    <span style="font-size:13px;">Bakery Photo</span>
                </div>
            </div>
            <div class="col-lg-6">
                <p class="story-label">Who We Are</p>
                <h2 class="story-heading">A Family Bakery Since Day One</h2>
                <p class="story-text">
                    {{ config('app.name') }} started as a small neighbourhood bakery with one simple goal —
                    to bring freshly baked goodness to every home. What began as a passion for baking
                    has grown into a beloved local institution.
                </p>
                <p class="story-text">
                    Every morning our bakers arrive before sunrise to prepare the day's fresh bakes.
                    From classic bread loaves to celebration cakes, everything is made from scratch
                    using quality ingredients and time-tested recipes.
                </p>
                <p class="story-text">
                    We believe good food brings people together — and that's exactly what we've been
                    doing, one bake at a time.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="about-stats">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-num">10+</div>
                    <div class="stat-desc">Years of Baking</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-num">50+</div>
                    <div class="stat-desc">Menu Items</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-num">500+</div>
                    <div class="stat-desc">Happy Customers</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-num">100%</div>
                    <div class="stat-desc">Fresh Daily</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="about-values">
    <div class="container">
        <p class="section-label">What We Stand For</p>
        <h2 class="section-heading">Our Values</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-seedling"></i></div>
                    <div class="value-title">Fresh Ingredients</div>
                    <p class="value-text">We source fresh, quality ingredients every day. No preservatives, no shortcuts — just honest baking.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon" style="background:#FDE8EB;color:#B23A48;">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <div class="value-title">Made with Love</div>
                    <p class="value-text">Every item is handcrafted with care. We put our heart into every bake, big or small.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card">
                    <div class="value-icon" style="background:#E8F5E9;color:#388E3C;">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="value-title">Community First</div>
                    <p class="value-text">We're proud to be part of this community. Your celebrations are our celebrations too.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Team --}}
<section class="about-team">
    <div class="container">
        <p class="section-label">The People Behind the Oven</p>
        <h2 class="section-heading">Meet Our Team</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="team-card">
                    <div class="team-avatar">A</div>
                    <div class="team-name">Head Baker</div>
                    <div class="team-role">Master Baker</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="team-card">
                    <div class="team-avatar" style="background:linear-gradient(135deg,#B23A48,#C98B2E);">P</div>
                    <div class="team-name">Pastry Chef</div>
                    <div class="team-role">Cake & Pastry</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="team-card">
                    <div class="team-avatar" style="background:linear-gradient(135deg,#388E3C,#2B1B14);">S</div>
                    <div class="team-name">Store Manager</div>
                    <div class="team-role">Operations</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
