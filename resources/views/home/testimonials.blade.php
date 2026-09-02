<style>
    .kb-testimonial {
        background: #fff;
        border: 1px solid #EDE3D4;
        border-radius: 16px;
        padding: 30px 26px;
        height: 100%;
        position: relative;
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .kb-testimonial:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 32px rgba(44, 24, 16, 0.12);
    }

    .kb-quote-mark {
        position: absolute;
        top: 18px;
        right: 24px;
        font-size: 44px;
        color: #F4C430;
        opacity: .45;
        font-family: 'Fraunces', serif;
        line-height: 1;
    }

    .kb-stars {
        color: #F4C430;
        font-size: 13.5px;
        letter-spacing: 2px;
        margin-bottom: 14px;
    }

    .kb-testimonial p {
        font-size: 14.5px;
        line-height: 1.8;
        color: #4A3423;
        margin-bottom: 20px;
    }

    .kb-reviewer {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kb-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #B23A48, #8B4513);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 15px;
    }

    .kb-reviewer strong {
        display: block;
        font-size: 14px;
        color: #2C1810;
    }

    .kb-reviewer span {
        font-size: 12px;
        color: #8A7460;
    }
</style>

<section class="kb-section kb-section-alt">
    <div class="container">
        <div class="kb-section-head">
            <span class="kb-section-eyebrow">Testimonials</span>
            <h2 class="kb-section-title">What Our Customers Say</h2>
            <p class="kb-section-sub">Sweet words from our happy customers.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="kb-testimonial">
                    <span class="kb-quote-mark">&rdquo;</span>
                    <div class="kb-stars">★★★★★</div>
                    <p>"The cake was absolutely delicious and beautifully designed. Everyone loved it!"</p>
                    <div class="kb-reviewer">
                        <div class="kb-avatar">P</div>
                        <div><strong>Priya</strong><span>Birthday order</span></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="kb-testimonial">
                    <span class="kb-quote-mark">&rdquo;</span>
                    <div class="kb-stars">★★★★★</div>
                    <p>"Fresh, tasty, and delivered with great care. Highly recommended!"</p>
                    <div class="kb-reviewer">
                        <div class="kb-avatar">R</div>
                        <div><strong>Rahul</strong><span>Regular customer</span></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="kb-testimonial">
                    <span class="kb-quote-mark">&rdquo;</span>
                    <div class="kb-stars">★★★★★</div>
                    <p>"Ordered a birthday cake and it made our celebration even more special. Thank you!"</p>
                    <div class="kb-reviewer">
                        <div class="kb-avatar">A</div>
                        <div><strong>Ananya</strong><span>Custom cake</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
