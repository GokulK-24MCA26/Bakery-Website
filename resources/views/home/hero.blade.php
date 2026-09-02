<style>
    .kb-hero {
        position: relative;
        min-height: 640px;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: #2C1810;
        isolation: isolate;
    }

    /* Premium clarity — image layer with brightness/saturate boost */
    .kb-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('images/slider/slide1.jpg') }}') center/cover no-repeat;
        filter: brightness(1.08) contrast(1.06) saturate(1.14);
        image-rendering: -webkit-optimize-contrast;
        transform: translateZ(0);
        z-index: 0;
    }

    .kb-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: 1;
        /* Lighter gradient for premium visibility - image pops more */
        background: linear-gradient(100deg,
                rgba(30, 16, 10, 0.78) 0%,
                rgba(44, 24, 16, 0.58) 46%,
                rgba(44, 24, 16, 0.18) 100%);
    }

    .kb-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 24px;
        width: 100%;
    }

    .kb-hero-content {
        max-width: 560px;
        color: #FFF8F0;
    }

    .kb-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #F4C430;
        margin-bottom: 18px;
    }

    .kb-eyebrow::before {
        content: '';
        width: 28px;
        height: 2px;
        background: #F4C430;
    }

    .kb-hero h1 {
        font-family: 'Fraunces', serif;
        font-size: clamp(34px, 5vw, 54px);
        font-weight: 600;
        line-height: 1.15;
        margin-bottom: 20px;
    }

    .kb-hero h1 em {
        font-style: italic;
        color: #F4C430;
    }

    .kb-hero p {
        font-size: 16.5px;
        line-height: 1.75;
        color: rgba(255, 248, 240, 0.85);
        margin-bottom: 32px;
    }

    .kb-hero-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 40px;
    }

    .btn-kb-primary {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 14px 30px;
        background: #B23A48;
        color: #fff;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        transition: background .2s, transform .2s;
    }

    .btn-kb-primary:hover {
        background: #98303D;
        color: #fff;
        transform: translateY(-2px);
    }

    .btn-kb-outline {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 14px 30px;
        border: 1.5px solid rgba(255, 248, 240, 0.55);
        color: #FFF8F0;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        backdrop-filter: blur(4px);
        transition: all .2s;
    }

    .btn-kb-outline:hover {
        background: rgba(255, 248, 240, 0.14);
        border-color: #F4C430;
        color: #fff;
    }

    .kb-hero-badges {
        display: flex;
        gap: 22px;
        flex-wrap: wrap;
    }

    .kb-badge {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 13.5px;
        color: rgba(255, 248, 240, 0.9);
    }

    .kb-badge i {
        color: #F4C430;
        font-size: 15px;
    }

    @media (max-width: 767.98px) {
        .kb-hero {
            min-height: 560px;
            text-align: center;
        }
        .kb-hero::after {
            background-position: 62% center;
        }

        .kb-hero-content {
            max-width: 100%;
        }

        .kb-eyebrow {
            justify-content: center;
        }

        .kb-eyebrow::before {
            display: none;
        }

        .kb-hero-actions,
        .kb-hero-badges {
            justify-content: center;
        }
    }
</style>

<section class="kb-hero">
    <div class="kb-hero-inner">
        <div class="kb-hero-content">
            <span class="kb-eyebrow">Welcome to GMS Bakery</span>
            <h1>Freshly Baked <em>Happiness,</em> Every Single Day</h1>
            <p>
                From celebration cakes to everyday treats — everything is baked fresh
                each morning with premium ingredients and a whole lot of love.
            </p>

            <div class="kb-hero-actions">
                <a href="{{ route('products.all') }}" class="btn-kb-primary">
                    <i class="fa-solid fa-cake-candles"></i> Explore Products
                </a>
                <a href="{{ route('contact') }}" class="btn-kb-outline">
                    <i class="fa-solid fa-phone"></i> Contact Us
                </a>
            </div>

            <div class="kb-hero-badges">
                <span class="kb-badge"><i class="fa-solid fa-star"></i> Loved by locals</span>
                <span class="kb-badge"><i class="fa-solid fa-wheat-awn"></i> Baked fresh daily</span>
                <span class="kb-badge"><i class="fa-solid fa-truck-fast"></i> Local delivery</span>
            </div>
        </div>
    </div>
</section>
