<style>
    .kb-about-img {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
        min-height: 340px;
        box-shadow: 0 18px 44px rgba(44, 24, 16, 0.18);
    }

    .kb-about-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        /* Premium clarity */
        filter: brightness(1.08) contrast(1.07) saturate(1.13);
        image-rendering: -webkit-optimize-contrast;
        backface-visibility: hidden;
        transform: translateZ(0);
        transition: transform .5s ease, filter .3s ease;
    }
    .kb-about-img:hover img {
        transform: scale(1.03);
        filter: brightness(1.11) contrast(1.08) saturate(1.16);
    }

    .kb-about-exp {
        position: absolute;
        bottom: 22px;
        left: 22px;
        background: #FFF8F0;
        border-radius: 14px;
        padding: 16px 22px;
        box-shadow: 0 10px 26px rgba(30, 16, 10, 0.25);
        text-align: center;
    }

    .kb-about-exp strong {
        display: block;
        font-family: 'Fraunces', serif;
        font-size: 28px;
        font-weight: 600;
        color: #B23A48;
        line-height: 1;
    }

    .kb-about-exp span {
        font-size: 11.5px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #8A7460;
    }

    .kb-about-copy {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .kb-check-list {
        list-style: none;
        padding: 0;
        margin: 22px 0 30px;
    }

    .kb-check-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 14.5px;
        color: #4A3423;
        margin-bottom: 13px;
    }

    .kb-check-list i {
        color: #2E7D32;
        margin-top: 2px;
    }
</style>

<section class="kb-section kb-section-alt">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="kb-about-img">
                    <img src="{{ asset('images/slider/slide2.jpg') }}" alt="Inside our bakery" loading="lazy">
                    <div class="kb-about-exp">
                        <strong>10+</strong>
                        <span>Years of Baking</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="kb-about-copy">
                    <span class="kb-section-eyebrow">Our Story</span>
                    <h2 class="kb-section-title" style="text-align:left;">Baked With Love Since Day One</h2>
                    <p class="kb-section-sub" style="text-align:left;">
                        What started as a small family kitchen in Erode has grown into
                        the town's favourite bakery — without ever compromising on the homemade taste.
                    </p>

                    <ul class="kb-check-list">
                        <li><i class="fa-solid fa-circle-check"></i> Traditional recipes, modern standards of hygiene</li>
                        <li><i class="fa-solid fa-circle-check"></i> No compromises — real butter, fresh cream, quality flour</li>
                        <li><i class="fa-solid fa-circle-check"></i> Custom cakes for birthdays, weddings & every celebration</li>
                        <li><i class="fa-solid fa-circle-check"></i> Friendly service that treats you like family</li>
                    </ul>

                    <div>
                        <a href="{{ route('about') }}" class="btn-kb-primary">
                            Know More About Us <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
