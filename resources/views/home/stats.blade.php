<style>
    .kb-stats {
        background: #2C1810;
        padding: 34px 0;
    }

    .kb-stats-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .kb-stat {
        text-align: center;
    }

    .kb-stat-value {
        font-family: 'Fraunces', serif;
        font-size: 30px;
        font-weight: 600;
        color: #F4C430;
        line-height: 1.1;
    }

    .kb-stat-label {
        font-size: 12.5px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: rgba(255, 248, 240, 0.65);
        margin-top: 6px;
    }

    @media (max-width: 767.98px) {
        .kb-stats-inner {
            grid-template-columns: repeat(2, 1fr);
            gap: 26px 12px;
        }

        .kb-stat-value { font-size: 24px; }
    }
</style>

<section class="kb-stats">
    <div class="kb-stats-inner">
        <div class="kb-stat">
            <div class="kb-stat-value">10+</div>
            <div class="kb-stat-label">Years Baking</div>
        </div>
        <div class="kb-stat">
            <div class="kb-stat-value">50+</div>
            <div class="kb-stat-label">Delicious Items</div>
        </div>
        <div class="kb-stat">
            <div class="kb-stat-value">5000+</div>
            <div class="kb-stat-label">Happy Customers</div>
        </div>
        <div class="kb-stat">
            <div class="kb-stat-value">100%</div>
            <div class="kb-stat-label">Fresh Every Day</div>
        </div>
    </div>
</section>
