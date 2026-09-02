@php
    $categoryRoutes = [
        'cakes' => 'products.cakes',
        'cupcakes' => 'products.cupcakes',
        'cookies' => 'products.cookies',
        'breads' => 'products.breads',
        'donuts & desserts' => 'products.donuts',
        'donuts' => 'products.donuts',
    ];
@endphp

<style>
    .kb-section {
        padding: 84px 0;
    }

    .kb-section-alt {
        background: #FFF8F0;
    }

    .kb-section-head {
        text-align: center;
        max-width: 560px;
        margin: 0 auto 48px;
    }

    .kb-section-eyebrow {
        display: inline-block;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #B23A48;
        margin-bottom: 10px;
    }

    .kb-section-title {
        font-family: 'Fraunces', serif;
        font-size: clamp(26px, 3.4vw, 36px);
        font-weight: 600;
        color: #2C1810;
        margin-bottom: 12px;
    }

    .kb-section-sub {
        color: #8A7460;
        font-size: 15.5px;
        line-height: 1.7;
    }

    .kb-cat-card {
        position: relative;
        display: block;
        border-radius: 16px;
        overflow: hidden;
        height: 230px;
        text-decoration: none;
        box-shadow: 0 6px 20px rgba(44, 24, 16, 0.08);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .kb-cat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 32px rgba(44, 24, 16, 0.16);
    }

    .kb-cat-card img,
    .kb-cat-ph {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Premium clarity boost */
        filter: brightness(1.08) contrast(1.07) saturate(1.14);
        image-rendering: -webkit-optimize-contrast;
        backface-visibility: hidden;
        transform: translateZ(0);
        transition: transform .45s ease, filter .3s ease;
    }

    .kb-cat-ph {
        background: #EDE3D4;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #B8A489;
        font-size: 30px;
    }

    .kb-cat-card:hover img {
        transform: scale(1.08);
        filter: brightness(1.12) contrast(1.08) saturate(1.18);
    }

    .kb-cat-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 35%, rgba(30, 16, 10, 0.82) 100%);
    }

    .kb-cat-label {
        position: absolute;
        left: 18px;
        right: 18px;
        bottom: 16px;
        z-index: 2;
        color: #FFF8F0;
        font-family: 'Fraunces', serif;
        font-size: 19px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .kb-cat-label i {
        font-size: 13px;
        opacity: 0;
        transform: translateX(-6px);
        transition: all .25s ease;
        color: #F4C430;
    }

    .kb-cat-card:hover .kb-cat-label i {
        opacity: 1;
        transform: translateX(0);
    }
</style>

<section class="kb-section" id="categories">
    <div class="container">
        <div class="kb-section-head">
            <span class="kb-section-eyebrow">Our Menu</span>
            <h2 class="kb-section-title">Browse Our Categories</h2>
            <p class="kb-section-sub">Pick your favourite — everything is freshly baked in small batches every day.</p>
        </div>

        <div class="row g-4">
            @foreach ($categories as $category)
                @php
                    $cleanName = strtolower(trim(preg_replace('/^[^a-zA-Z]+/', '', $category->name)));
                    $routeName = $categoryRoutes[$cleanName] ?? null;
                    $displayName = preg_replace('/^[^a-zA-Z]+/', '', $category->name);
                @endphp

                <div class="col-6 col-md-4 col-lg-3">
                    @if($routeName)
                        <a href="{{ route($routeName) }}" class="kb-cat-card">
                    @else
                        <div class="kb-cat-card">
                    @endif
                            @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $displayName }}" loading="lazy">
                            @else
                                <div class="kb-cat-ph"><i class="fa-solid fa-image"></i></div>
                            @endif
                            <div class="kb-cat-label">
                                {{ $displayName }}
                                @if($routeName)<i class="fa-solid fa-arrow-right"></i>@endif
                            </div>
                    @if($routeName)
                        </a>
                    @else
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('products.all') }}" class="btn-kb-primary" style="padding:13px 28px; border-radius:10px;">
                View All Products <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
