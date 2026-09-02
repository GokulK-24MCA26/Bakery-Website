<style>
    .kb-product-card {
        background: #fff;
        border: 1px solid #EDE3D4;
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .kb-product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 32px rgba(44, 24, 16, 0.14);
    }

    .kb-product-media {
        position: relative;
        height: 190px;
        overflow: hidden;
    }

    .kb-product-media img,
    .kb-product-ph {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Premium image clarity */
        filter: brightness(1.08) contrast(1.06) saturate(1.14);
        image-rendering: -webkit-optimize-contrast;
        backface-visibility: hidden;
        transform: translateZ(0);
        transition: transform .45s ease, filter .3s ease;
    }

    .kb-product-ph {
        background: #EDE3D4;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #B8A489;
        font-size: 30px;
    }

    .kb-product-card:hover .kb-product-media img {
        transform: scale(1.08);
        filter: brightness(1.12) contrast(1.07) saturate(1.18);
    }

    .kb-flag {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 2;
        background: #B23A48;
        color: #fff;
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        padding: 5px 11px;
        border-radius: 20px;
    }

    .kb-product-body {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
        text-align: center;
    }

    .kb-product-name {
        font-family: 'Fraunces', serif;
        font-size: 17.5px;
        font-weight: 500;
        color: #2C1810;
        margin-bottom: 6px;
    }

    .kb-product-price {
        font-size: 15.5px;
        font-weight: 700;
        color: #B23A48;
        margin-bottom: 14px;
    }

    .btn-kb-order {
        margin-top: auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px;
        border-radius: 9px;
        background: #2C1810;
        color: #FFF8F0;
        font-size: 13.5px;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s, transform .15s;
    }

    .btn-kb-order:hover {
        background: #B23A48;
        color: #fff;
        transform: translateY(-1px);
    }
</style>

<section class="kb-section kb-section-alt">
    <div class="container">
        <div class="kb-section-head">
            <span class="kb-section-eyebrow">Customer Favourites</span>
            <h2 class="kb-section-title">Featured Products</h2>
            <p class="kb-section-sub">The treats our customers keep coming back for — order in a few taps.</p>
        </div>

        <div class="row g-4">
            @foreach ($featuredProducts as $product)
                <div class="col-6 col-lg-3 col-md-4">
                    <div class="kb-product-card">
                        <div class="kb-product-media">
                            @if ($loop->first)
                                <span class="kb-flag">Bestseller</span>
                            @endif
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ preg_replace('/^[^a-zA-Z]+/', '', $product->name) }}" loading="lazy">
                            @else
                                <div class="kb-product-ph"><i class="fa-solid fa-image"></i></div>
                            @endif
                        </div>
                        <div class="kb-product-body">
                            <h5 class="kb-product-name">{{ preg_replace('/^[^a-zA-Z]+/', '', $product->name) }}</h5>
                            <div class="kb-product-price">₹{{ number_format($product->price, 2) }}</div>
                            @auth
                                <a href="{{ route('orders.create', $product) }}" class="btn-kb-order">
                                    <i class="fa-solid fa-bag-shopping"></i> Order Now
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-kb-order">
                                    <i class="fa-solid fa-bag-shopping"></i> Order Now
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($featuredProducts->isEmpty())
                <div class="col-12 text-center" style="color:#8A7460;">Products coming soon!</div>
            @endif
        </div>
    </div>
</section>
