@extends('layouts.app')

@section('title', 'All Products | GMS Bakery - Cakes, Breads, Cookies & More')

@php
    // helper to clean emoji/prefix from name
    $clean = fn($n) => preg_replace('/^[^a-zA-Z]+/', '', $n);
@endphp

@section('content')
<style>
    /* ── PRODUCTS PAGE PREMIUM ─────────────────────── */
    .pr-hero {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(820px 420px at 15% -10%, rgba(244,196,48,.18), transparent 60%),
            radial-gradient(700px 400px at 95% 0%, rgba(178,58,72,.22), transparent 60%),
            linear-gradient(118deg, #2C1810 0%, #3A2014 46%, #6B2E1A 100%);
        color: #FFF8F0;
        padding: 56px 0 46px;
    }
    .pr-hero::after {
        content:'';
        position:absolute;
        inset:0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity:.55;
        pointer-events:none;
    }
    .pr-hero-inner {
        position:relative; z-index:2;
        max-width:1200px; margin:0 auto; padding:0 24px;
    }
    .pr-hero-grid {
        display:grid; grid-template-columns: 1.35fr .9fr; gap:32px; align-items:center;
    }
    @media (max-width: 880px){ .pr-hero-grid{ grid-template-columns:1fr; } .pr-hero-visual{ display:none; } }
    .pr-eyebrow {
        display:inline-flex; align-items:center; gap:9px;
        font-size:12px; font-weight:700; letter-spacing:2.6px; text-transform:uppercase;
        color:#F4C430; margin-bottom:12px;
    }
    .pr-eyebrow::before{ content:''; width:28px; height:2px; background:#F4C430; border-radius:2px; }
    .pr-title {
        font-family:'Fraunces', serif;
        font-size: clamp(30px, 4.6vw, 46px);
        font-weight:600; line-height:1.08; margin-bottom:14px;
    }
    .pr-title em { font-style:italic; color:#F4C430; font-weight:600; }
    .pr-sub {
        color: rgba(255,248,240,.82);
        font-size:15.8px; line-height:1.75; max-width: 560px;
        margin-bottom:22px;
    }
    .pr-meta {
        display:flex; gap:12px; flex-wrap:wrap; align-items:center;
        margin-bottom:22px;
    }
    .pr-meta-chip {
        display:inline-flex; align-items:center; gap:7px;
        background: rgba(255,248,240,.10);
        border:1px solid rgba(255,248,240,.16);
        backdrop-filter: blur(6px);
        color:#FFF8F0; font-size:13px; font-weight:600;
        padding:8px 12px; border-radius:999px;
    }
    .pr-meta-chip i{ color:#F4C430; }
    .pr-search-wrap {
        position:relative; max-width: 520px;
    }
    .pr-search-wrap i {
        position:absolute; left:16px; top:50%; transform:translateY(-50%);
        color:#8A7460; font-size:14px;
    }
    .pr-search {
        width:100%; padding:14px 16px 14px 44px;
        border-radius:12px; border:1.5px solid rgba(255,248,240,.16);
        background: rgba(255,248,240,.96);
        color:#2C1810; font-size:15px; font-weight:500;
        outline:none; transition: border-color .2s, box-shadow .2s, background .2s;
        box-shadow: 0 10px 30px rgba(0,0,0,.18);
    }
    .pr-search::placeholder{ color:#A89078; }
    .pr-search:focus{
        border-color:#F4C430; background:#fff;
        box-shadow: 0 10px 30px rgba(0,0,0,.20), 0 0 0 4px rgba(244,196,48,.20);
    }
    .pr-search-hint{
        margin-top:9px; font-size:12.5px; color:rgba(255,248,240,.68);
    }
    /* visual card */
    .pr-hero-visual{
        position:relative; border-radius:18px; overflow:hidden;
        background:#FFF8F0; box-shadow: 0 18px 50px rgba(0,0,0,.28);
        border:1px solid rgba(255,248,240,.18);
        min-height: 300px;
    }
    .pr-hero-visual img{
        width:100%; height:320px; object-fit:cover; display:block;
        filter: brightness(1.08) contrast(1.06) saturate(1.12);
        image-rendering: -webkit-optimize-contrast;
    }
    .pr-hero-visual::after{
        content:''; position:absolute; inset:0;
        background: linear-gradient(180deg, transparent 55%, rgba(44,24,16,.22) 100%);
        pointer-events:none;
    }
    .pr-visual-badge{
        position:absolute; bottom:14px; left:14px; right:14px; z-index:2;
        background: rgba(255,248,240,.96);
        border-radius:12px; padding:12px 14px;
        display:flex; align-items:center; justify-content:space-between; gap:10px;
        box-shadow: 0 8px 22px rgba(44,24,16,.14);
    }
    .pr-visual-badge strong{ font-family:'Fraunces',serif; color:#2C1810; font-size:15px; }
    .pr-visual-badge span{ font-size:12.5px; color:#8A7460; }
    .pr-visual-badge .dot{ width:8px; height:8px; border-radius:50%; background:#2E7D32; box-shadow:0 0 0 6px rgba(46,125,50,.15); }

    /* ── FILTER BAR (sticky) ───────────────────────── */
    .pr-filter-bar{
        position: sticky; top:68px; z-index: 40;
        background: rgba(255,248,240,.92);
        backdrop-filter: blur(10px) saturate(1.15);
        -webkit-backdrop-filter: blur(10px) saturate(1.15);
        border-bottom:1px solid #F0E4CC;
        box-shadow: 0 4px 18px rgba(44,24,16,.06);
    }
    .pr-filter-inner{
        max-width:1200px; margin:0 auto; padding:14px 24px;
        display:flex; gap:14px; align-items:center; justify-content:space-between; flex-wrap:wrap;
    }
    .pr-chips{ display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
    .pr-chip{
        appearance:none; border:1.5px solid #EDE3D4; background:#fff;
        color:#2C1810; font-size:13.5px; font-weight:600;
        padding:8px 14px; border-radius:999px; cursor:pointer;
        transition: all .18s ease;
        display:inline-flex; align-items:center; gap:7px;
        white-space:nowrap;
    }
    .pr-chip:hover{ border-color:#D9CABD; transform: translateY(-1px); }
    .pr-chip.active{
        background:#2C1810; color:#FFF8F0; border-color:#2C1810;
        box-shadow: 0 6px 16px rgba(44,24,16,.18);
    }
    .pr-chip .count{
        background: rgba(0,0,0,.06); color:inherit;
        font-size:11px; font-weight:700; padding:2px 7px; border-radius:999px;
    }
    .pr-chip.active .count{ background: rgba(255,255,255,.16); color:#F4C430; }
    .pr-tools{ display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
    .pr-select{
        border:1.5px solid #EDE3D4; background:#fff; color:#2C1810;
        font-size:13.5px; font-weight:600; padding:9px 12px; border-radius:10px;
        outline:none; cursor:pointer;
    }
    .pr-select:focus{ border-color:#F4C430; }
    .pr-results{ font-size:13.5px; color:#8A7460; font-weight:500; }

    /* ── CONTENT WRAP ──────────────────────────────── */
    .pr-wrap{ background:#FBF3E4; padding: 0 0 72px; }
    .pr-container{ max-width:1200px; margin:0 auto; padding:0 24px; }

    /* categories showcase */
    .pr-section-head{
        text-align:center; max-width: 640px; margin:0 auto 28px;
    }
    .pr-section-eyebrow{
        display:inline-block; font-size:11.5px; font-weight:700; letter-spacing:2.4px;
        text-transform:uppercase; color:#B23A48; margin-bottom:8px;
    }
    .pr-section-title{
        font-family:'Fraunces',serif; font-size: clamp(24px, 3.2vw, 32px);
        font-weight:600; color:#2C1810; margin-bottom:10px;
    }
    .pr-section-sub{ color:#8A7460; font-size:14.8px; line-height:1.7; }

    .pr-cat-grid{
        display:grid; grid-template-columns: repeat(5, 1fr); gap:16px; margin-bottom: 48px;
    }
    @media (max-width: 991px){ .pr-cat-grid{ grid-template-columns: repeat(3, 1fr);} }
    @media (max-width: 600px){ .pr-cat-grid{ grid-template-columns: repeat(2, 1fr);} }
    .pr-cat-card{
        position:relative; display:block; border-radius:16px; overflow:hidden;
        height: 168px; text-decoration:none;
        background:#FFF8F0; border:1px solid #EDE3D4;
        box-shadow: 0 6px 18px rgba(44,24,16,.06);
        transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease;
    }
    .pr-cat-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 14px 30px rgba(44,24,16,.14);
        border-color:#F4C430;
    }
    .pr-cat-card img{
        width:100%; height:100%; object-fit:cover; display:block;
        filter: brightness(1.07) contrast(1.07) saturate(1.12);
        transition: transform .45s ease, filter .3s ease;
        image-rendering: -webkit-optimize-contrast;
    }
    .pr-cat-card:hover img{ transform: scale(1.06); filter: brightness(1.10) contrast(1.08) saturate(1.15); }
    .pr-cat-card::after{
        content:''; position:absolute; inset:0;
        background: linear-gradient(180deg, rgba(30,16,10,0) 28%, rgba(30,16,10,.78) 100%);
    }
    .pr-cat-empty{
        width:100%; height:100%; display:flex; align-items:center; justify-content:center;
        background:#EDE3D4; color:#B8A489; font-size:28px;
    }
    .pr-cat-label{
        position:absolute; left:12px; right:12px; bottom:12px; z-index:2;
        color:#FFF8F0; font-family:'Fraunces',serif; font-size:15.5px; font-weight:600;
        display:flex; align-items:center; justify-content:space-between; gap:8px;
        text-shadow: 0 1px 10px rgba(0,0,0,.35);
    }
    .pr-cat-label small{
        display:block; font-family:'Work Sans',sans-serif; font-size:11px; font-weight:600;
        letter-spacing:.8px; text-transform:uppercase; opacity:.85; font-weight:500;
    }
    .pr-cat-arrow{
        width:28px; height:28px; border-radius:50%; flex:0 0 28px;
        background: rgba(255,248,240,.18); border:1px solid rgba(255,248,240,.30);
        display:flex; align-items:center; justify-content:center;
        font-size:11px; color:#F4C430; backdrop-filter: blur(4px);
        transition: all .2s ease;
    }
    .pr-cat-card:hover .pr-cat-arrow{ background:#F4C430; color:#2C1810; border-color:#F4C430; }

    /* ── PRODUCT GRID ──────────────────────────────── */
    .pr-product-grid{
        display:grid; grid-template-columns: repeat(4, 1fr); gap:18px;
    }
    @media (max-width: 991px){ .pr-product-grid{ grid-template-columns: repeat(3, 1fr);} }
    @media (max-width: 700px){ .pr-product-grid{ grid-template-columns: repeat(2, 1fr); gap:12px;} }
    @media (max-width: 400px){ .pr-product-grid{ grid-template-columns: 1fr; } }

    .pr-card{
        background:#fff; border:1px solid #EDE3D4; border-radius:16px; overflow:hidden;
        display:flex; flex-direction:column; height:100%;
        box-shadow: 0 4px 14px rgba(44,24,16,.05);
        transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease;
    }
    .pr-card:hover{
        transform: translateY(-6px);
        box-shadow: 0 14px 32px rgba(44,24,16,.13);
        border-color:#F0E4CC;
    }
    .pr-card-media{
        position:relative; height: 204px; overflow:hidden; background:#F9EED7;
    }
    @media (max-width: 700px){ .pr-card-media{ height:170px; } }
    .pr-card-media img{
        width:100%; height:100%; object-fit:cover; display:block;
        filter: brightness(1.07) contrast(1.07) saturate(1.12);
        image-rendering: -webkit-optimize-contrast;
        transition: transform .45s ease, filter .3s ease;
    }
    .pr-card:hover .pr-card-media img{ transform: scale(1.07); filter: brightness(1.11) contrast(1.08) saturate(1.16); }
    .pr-card-ph{
        width:100%; height:100%; display:flex; align-items:center; justify-content:center;
        background: linear-gradient(135deg, #EDE3D4, #F9EED7); color:#B8A489; font-size:30px;
    }
    .pr-badge-cat{
        position:absolute; top:10px; left:10px; z-index:2;
        background: rgba(255,248,240,.96); color:#2C1810;
        font-size:11px; font-weight:700; letter-spacing:.7px; text-transform:uppercase;
        padding:6px 10px; border-radius:999px; border:1px solid #EDE3D4;
        box-shadow: 0 4px 12px rgba(44,24,16,.10);
    }
    .pr-badge-price{
        position:absolute; bottom:10px; right:10px; z-index:2;
        background:#B23A48; color:#fff; font-size:13px; font-weight:700;
        padding:6px 12px; border-radius:999px;
        box-shadow: 0 6px 16px rgba(178,58,72,.30);
    }
    .pr-card-body{
        padding:14px 14px 12px; display:flex; flex-direction:column; flex:1; gap:6px;
    }
    .pr-card-name{
        font-family:'Fraunces',serif; font-size:16px; font-weight:600; color:#2C1810;
        line-height:1.25; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
        min-height: 40px;
    }
    .pr-card-desc{
        font-size:12.8px; color:#8A7460; line-height:1.6;
        display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
        min-height: 38px;
    }
    .pr-card-foot{
        display:flex; align-items:center; justify-content:space-between; gap:10px;
        margin-top:auto; padding-top:10px; border-top:1px dashed #F0E4CC;
    }
    .pr-price{
        font-size:15px; font-weight:800; color:#B23A48;
    }
    .pr-price small{ font-size:11px; font-weight:600; color:#8A7460; }
    .pr-btn{
        display:inline-flex; align-items:center; justify-content:center; gap:7px;
        background:#2C1810; color:#FFF8F0; font-size:13px; font-weight:700;
        padding:9px 14px; border-radius:9px; text-decoration:none;
        transition: background .18s, transform .18s, box-shadow .18s;
        white-space:nowrap; border:none; cursor:pointer;
    }
    .pr-btn:hover{ background:#B23A48; color:#fff; transform: translateY(-1px); box-shadow: 0 8px 18px rgba(178,58,72,.22); }
    .pr-btn:active{ transform: translateY(0); }

    /* empty */
    .pr-empty{
        grid-column: 1 / -1;
        text-align:center; padding:56px 20px;
        background:#fff; border:1.5px dashed #EDE3D4; border-radius:16px;
        color:#8A7460;
    }
    .pr-empty i{ font-size:30px; color:#E6B800; margin-bottom:12px; display:block; }

    /* breadcrumb */
    .pr-crumb{ font-size:13px; color:rgba(255,248,240,.68); margin-bottom:10px; }
    .pr-crumb a{ color:rgba(255,248,240,.85); text-decoration:none; }
    .pr-crumb a:hover{ color:#F4C430; }
</style>

{{-- ── HERO ──────────────────────────────── --}}
<section class="pr-hero">
    <div class="pr-hero-inner">
        <div class="pr-hero-grid">
            <div>
                <div class="pr-crumb">
                    <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Home</a>
                    <span style="opacity:.6; margin:0 6px;">/</span>
                    <span style="color:#F4C430; font-weight:600;">Products</span>
                </div>
                <div class="pr-eyebrow">Fresh • Premium • Baked Daily</div>
                <h1 class="pr-title">Our Complete <em>Bakery<br>Collection</em></h1>
                <p class="pr-sub">
                    Explore every category — from celebration cakes to cookies, breads & desserts.
                    All items baked fresh each morning with premium ingredients.
                </p>
                <div class="pr-meta">
                    <span class="pr-meta-chip"><i class="fa-solid fa-layer-group"></i> {{ $categories->count() }} Categories</span>
                    <span class="pr-meta-chip"><i class="fa-solid fa-bag-shopping"></i> {{ $products->count() }} Products</span>
                    <span class="pr-meta-chip"><i class="fa-solid fa-star"></i> Bestsellers fresh today</span>
                </div>
                <div class="pr-search-wrap">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input id="prSearch" type="text" class="pr-search" placeholder="Search cakes, breads, cookies…  (eg. chocolate, red velvet)" autocomplete="off">
                </div>
                <div class="pr-search-hint">Tip: type to filter instantly • click a category chip to filter</div>
            </div>
            <div class="pr-hero-visual">
                @php
                    $heroImg = $products->firstWhere('image','!=',null) ?? null;
                    $heroCategory = $heroImg?->category;
                @endphp
                @if($heroImg && $heroImg->image)
                    <img src="{{ asset('storage/'.$heroImg->image) }}" alt="{{ $clean($heroImg->name) }}" loading="eager" fetchpriority="high">
                @else
                    <img src="{{ asset('images/slider/slide1.jpg') }}" alt="Bakery hero" loading="eager">
                @endif
                <div class="pr-visual-badge">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span class="dot"></span>
                        <div>
                            <strong>Baked fresh today</strong><br>
                            <span>{{ $products->count() }} items • Ready to order</span>
                        </div>
                    </div>
                    <a href="#all-products" class="pr-btn" style="padding:8px 12px; font-size:12.5px;"><i class="fa-solid fa-arrow-down"></i> Browse</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── STICKY FILTER BAR ─────────────────── --}}
<div class="pr-filter-bar" id="filterBar">
    <div class="pr-filter-inner">
        <div class="pr-chips" id="prChips">
            <button class="pr-chip active" data-filter="all">
                <i class="fa-solid fa-border-all"></i> All
                <span class="count">{{ $products->count() }}</span>
            </button>
            @foreach($categories as $cat)
                @php
                    $cname = $clean($cat->name);
                    $slug = strtolower(trim($cname));
                    $cnt = $cat->products_count ?? $products->where('category_id',$cat->id)->count();
                @endphp
                <button class="pr-chip" data-filter="{{ $cat->id }}" data-slug="{{ $slug }}">
                    {{ $cname }} <span class="count">{{ $cnt }}</span>
                </button>
            @endforeach
        </div>
        <div class="pr-tools">
            <span class="pr-results" id="prResults">{{ $products->count() }} items</span>
            <select id="prSort" class="pr-select" aria-label="Sort products">
                <option value="latest">Latest first</option>
                <option value="price-asc">Price: Low → High</option>
                <option value="price-desc">Price: High → Low</option>
                <option value="name-asc">Name: A → Z</option>
            </select>
        </div>
    </div>
</div>

{{-- ── CONTENT ───────────────────────────── --}}
<div class="pr-wrap">
    <div class="pr-container">

        {{-- Categories showcase --}}
        <section style="padding: 36px 0 0;">
            <div class="pr-section-head">
                <span class="pr-section-eyebrow">Browse by Category</span>
                <h2 class="pr-section-title">Pick Your Favourite</h2>
                <p class="pr-section-sub">Tap a category to filter the collection instantly — or scroll to see all products.</p>
            </div>
            <div class="pr-cat-grid">
                @forelse($categories as $cat)
                    @php
                        $cname = $clean($cat->name);
                        $slug = strtolower(trim($cname));
                        $routeName = $categoryRoutes[$slug] ?? null;
                        $cnt = $cat->products_count ?? 0;
                    @endphp
                    @if($routeName)
                        <a href="{{ route($routeName) }}" class="pr-cat-card" title="View {{ $cname }}" data-cat-filter="{{ $cat->id }}">
                    @else
                        <button type="button" class="pr-cat-card" data-cat-filter="{{ $cat->id }}" style="width:100%; padding:0; cursor:pointer;">
                    @endif
                        @if($cat->image)
                            <img src="{{ asset('storage/'.$cat->image) }}" alt="{{ $cname }}" loading="lazy">
                        @else
                            <div class="pr-cat-empty"><i class="fa-solid fa-image"></i></div>
                        @endif
                        <div class="pr-cat-label">
                            <span>{{ $cname }}<small>{{ $cnt }} items</small></span>
                            <span class="pr-cat-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    @if($routeName)
                        </a>
                    @else
                        </button>
                    @endif
                @empty
                    <div style="grid-column:1/-1; text-align:center; color:#8A7460; padding:20px;">Categories coming soon!</div>
                @endforelse
            </div>
        </section>

        {{-- Products grid --}}
        <section id="all-products" style="padding-top: 10px;">
            <div class="pr-section-head" style="margin-bottom: 20px;">
                <span class="pr-section-eyebrow">All Products</span>
                <h2 class="pr-section-title" style="font-size:24px;">Hand-picked for you</h2>
            </div>

            <div class="pr-product-grid" id="prGrid">
                @forelse($products as $product)
                    @php
                        $pname = $clean($product->name);
                        $catName = $product->category ? $clean($product->category->name) : 'Bakery';
                    @endphp
                    <div class="pr-card"
                         data-category="{{ $product->category_id }}"
                         data-name="{{ strtolower($pname.' '.$catName.' '.($product->description ?? '')) }}"
                         data-price="{{ $product->price }}"
                         data-date="{{ strtotime($product->created_at) }}"
                         data-pname="{{ strtolower($pname) }}">
                        <div class="pr-card-media">
                            <span class="pr-badge-cat">{{ $catName }}</span>
                            <span class="pr-badge-price">₹{{ number_format($product->price,0) }}</span>
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $pname }}" loading="lazy">
                            @else
                                <div class="pr-card-ph"><i class="fa-solid fa-cake-candles"></i></div>
                            @endif
                        </div>
                        <div class="pr-card-body">
                            <div class="pr-card-name" title="{{ $pname }}">{{ $pname }}</div>
                            @if($product->description)
                                <div class="pr-card-desc">{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 72) }}</div>
                            @else
                                <div class="pr-card-desc">Freshly baked with premium ingredients — order today.</div>
                            @endif
                            <div class="pr-card-foot">
                                <div class="pr-price">₹{{ number_format($product->price,2) }} <small>/ piece</small></div>
                                @auth
                                    <a href="{{ route('orders.create', $product) }}" class="pr-btn"><i class="fa-solid fa-bag-shopping"></i> Order</a>
                                @else
                                    <a href="{{ route('login') }}" class="pr-btn"><i class="fa-solid fa-bag-shopping"></i> Order</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="pr-empty">
                        <i class="fa-solid fa-face-smile"></i>
                        <h4 style="font-family:'Fraunces',serif; color:#2C1810; margin-bottom:8px;">Products coming soon!</h4>
                        <p style="margin:0;">We're baking something special — check back shortly.</p>
                    </div>
                @endforelse

                {{-- JS empty state --}}
                <div id="prEmpty" class="pr-empty" style="display:none;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <h4 style="font-family:'Fraunces',serif; color:#2C1810; margin-bottom:8px;">No products found</h4>
                    <p style="margin:0 0 12px;">Try a different search or category filter.</p>
                    <button type="button" onclick="resetFilters()" class="pr-btn" style="background:#B23A48;">Clear filters</button>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <div style="margin-top: 44px; background:#2C1810; border-radius:18px; padding:28px 22px; display:flex; flex-wrap:wrap; gap:18px; align-items:center; justify-content:space-between; color:#FFF8F0;">
            <div>
                <div style="font-family:'Fraunces',serif; font-size:20px; font-weight:600; margin-bottom:4px;">Can't find what you crave?</div>
                <div style="color:rgba(255,248,240,.72); font-size:13.8px;">We do custom cakes & bulk orders — talk to us.</div>
            </div>
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <a href="{{ route('contact') }}" class="pr-btn" style="background:#F4C430; color:#2C1810;"><i class="fa-solid fa-comments"></i> Contact Us</a>
                <a href="{{ route('gallery.public') }}" class="pr-btn" style="background:transparent; border:1.5px solid rgba(255,248,240,.30);"><i class="fa-solid fa-images"></i> View Gallery</a>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    const chips = document.querySelectorAll('#prChips .pr-chip');
    const cards = Array.from(document.querySelectorAll('#prGrid .pr-card'));
    const search = document.getElementById('prSearch');
    const sortSel = document.getElementById('prSort');
    const results = document.getElementById('prResults');
    const emptyEl = document.getElementById('prEmpty');
    const grid = document.getElementById('prGrid');
    let activeCat = 'all';
    let query = '';

    function applyFilters(){
        let visible = 0;
        const q = query.trim().toLowerCase();
        cards.forEach(card => {
            const cat = card.dataset.category;
            const name = card.dataset.name || '';
            const matchCat = (activeCat === 'all' || cat === activeCat);
            const matchSearch = !q || name.includes(q);
            const show = matchCat && matchSearch;
            card.style.display = show ? '' : 'none';
            if(show) visible++;
        });
        results.textContent = visible + ' item' + (visible!==1?'s':'');
        emptyEl.style.display = visible===0 && cards.length>0 ? '' : 'none';
        // if empty, ensure empty el not counted as card
        if(visible===0) grid.appendChild(emptyEl);
    }

    function setActiveChip(val){
        chips.forEach(c => c.classList.toggle('active', c.dataset.filter === val));
    }

    chips.forEach(chip => {
        chip.addEventListener('click', () => {
            activeCat = chip.dataset.filter;
            setActiveChip(activeCat);
            applyFilters();
            if(activeCat !== 'all'){
                document.getElementById('all-products')?.scrollIntoView({behavior:'smooth', block:'start'});
            }
        });
    });

    // category showcase cards also filter
    document.querySelectorAll('[data-cat-filter]').forEach(el=>{
        el.addEventListener('click', e=>{
            // if it's an <a> with route, allow navigation but also filter? we intercept only if not link?
            // For product filtering, buttons should filter; links go to dedicated page.
            // So only trigger if it's BUTTON (no href)
            if(el.tagName === 'BUTTON'){
                e.preventDefault();
                activeCat = el.dataset.catFilter;
                setActiveChip(activeCat);
                applyFilters();
                document.getElementById('all-products')?.scrollIntoView({behavior:'smooth', block:'start'});
            }
        });
    });

    search.addEventListener('input', e=>{
        query = e.target.value;
        applyFilters();
    });

    function resetFilters(){
        activeCat='all'; query=''; search.value='';
        setActiveChip('all');
        sortSel.value='latest';
        // reset sort to original order (latest first is default DOM order which is latest)
        // Re-append in original order
        cards.forEach(c=> grid.appendChild(c));
        grid.appendChild(emptyEl);
        applyFilters();
    }
    window.resetFilters = resetFilters;

    sortSel.addEventListener('change', ()=>{
        const v = sortSel.value;
        let sorted = [...cards];
        if(v==='price-asc') sorted.sort((a,b)=> parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
        else if(v==='price-desc') sorted.sort((a,b)=> parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
        else if(v==='name-asc') sorted.sort((a,b)=> (a.dataset.pname||'').localeCompare(b.dataset.pname||''));
        else if(v==='latest') sorted.sort((a,b)=> parseInt(b.dataset.date||0) - parseInt(a.dataset.date||0));
        sorted.forEach(c=> grid.appendChild(c));
        grid.appendChild(emptyEl);
        applyFilters();
    });

    // initial
    applyFilters();
</script>
@endpush
@endsection
