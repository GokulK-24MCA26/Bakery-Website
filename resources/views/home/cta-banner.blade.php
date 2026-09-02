<style>
    .kb-cta {
        position: relative;
        background: linear-gradient(115deg, #2C1810 0%, #4A2A18 55%, #8B4513 100%);
        border-radius: 24px;
        padding: 64px 40px;
        text-align: center;
        overflow: hidden;
    }

    .kb-cta::before,
    .kb-cta::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(244, 195, 48, 0.12);
    }

    .kb-cta::before {
        width: 260px;
        height: 260px;
        top: -110px;
        left: -80px;
    }

    .kb-cta::after {
        width: 340px;
        height: 340px;
        bottom: -170px;
        right: -110px;
    }

    .kb-cta h2 {
        position: relative;
        z-index: 2;
        font-family: 'Fraunces', serif;
        font-size: clamp(26px, 3.6vw, 38px);
        font-weight: 600;
        color: #FFF8F0;
        margin-bottom: 12px;
    }

    .kb-cta p {
        position: relative;
        z-index: 2;
        color: rgba(255, 248, 240, 0.8);
        font-size: 15.5px;
        margin-bottom: 32px;
    }

    .kb-cta-actions {
        position: relative;
        z-index: 2;
        display: flex;
        gap: 14px;
        justify-content: center;
        flex-wrap: wrap;
    }

    @media (max-width: 575.98px) {
        .kb-cta { padding: 46px 22px; border-radius: 18px; }
    }
</style>

<section style="padding: 0 0 84px;">
    <div class="container">
        <div class="kb-cta">
            <h2>Craving Something Sweet?</h2>
            <p>Order online in minutes or call us — we'll have it fresh and ready for you.</p>
            <div class="kb-cta-actions">
                <a href="{{ route('products.all') }}" class="btn-kb-primary">
                    <i class="fa-solid fa-bag-shopping"></i> Order Now
                </a>
                <a href="tel:+91 xxxxxxxxxx" class="btn-kb-outline">
                    <i class="fa-solid fa-phone"></i> +91 xxxxx xxxxx
                </a>
            </div>
        </div>
    </div>
</section>
