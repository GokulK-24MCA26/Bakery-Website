<style>
    /* =====================================
   KASTHURI BAKES - HERO SLIDER
===================================== */

    .hero-slider {
        width: 100%;
        overflow: hidden;
    }

    .hero-slider .carousel-item {
        position: relative;
        height: 620px;
    }

    /* Image */

    .hero-slide-img {
        width: 100%;
        height: 620px;
        object-fit: cover;
    }


    /* Dark overlay */

    .hero-overlay {
        position: absolute;
        inset: 0;

        background: linear-gradient(90deg,
                rgba(44, 24, 16, 0.85) 0%,
                rgba(44, 24, 16, 0.55) 45%,
                rgba(44, 24, 16, 0.15) 100%);
    }


    /* Caption */

    .hero-caption {
        position: absolute;

        top: 50%;
        left: 10%;

        transform: translateY(-50%);

        width: 600px;

        text-align: left;

        right: auto;
        bottom: auto;

        color: #ffffff;
    }


    /* Small heading */

    .hero-small {
        display: inline-block;

        color: #F4C430;

        font-size: 16px;
        font-weight: 600;

        margin-bottom: 15px;

        letter-spacing: 1px;
    }


    /* Main Heading */

    .hero-caption h1 {
        font-family: 'Poppins', sans-serif;

        font-size: 55px;
        font-weight: 700;

        line-height: 1.15;

        margin-bottom: 20px;
    }

    .hero-caption h1 span {
        color: #F4C430;
    }


    /* Paragraph */

    .hero-caption p {
        max-width: 550px;

        font-size: 17px;
        line-height: 1.8;

        color: #f5ebe6;

        margin-bottom: 30px;
    }


    /* Buttons */

    .hero-buttons {
        display: flex;
        gap: 15px;
    }


    .hero-btn-primary {
        background: #F4C430;
        color: #2C1810;

        border: 2px solid #F4C430;

        padding: 12px 28px;

        font-weight: 600;

        border-radius: 6px;

        transition: 0.3s;
    }

    .hero-btn-primary:hover {
        background: #8B4513;
        border-color: #8B4513;
        color: #ffffff;
    }


    .hero-btn-outline {
        background: transparent;

        color: #ffffff;

        border: 2px solid #ffffff;

        padding: 12px 28px;

        font-weight: 600;

        border-radius: 6px;

        transition: 0.3s;
    }

    .hero-btn-outline:hover {
        background: #ffffff;
        color: #2C1810;
    }


    /* Indicators */

    .hero-slider .carousel-indicators button {
        width: 10px;
        height: 10px;

        border-radius: 50%;

        background-color: #ffffff;
    }

    .hero-slider .carousel-indicators .active {
        background-color: #F4C430;
    }


    /* =====================================
   TABLET
===================================== */

    @media (max-width: 992px) {

        .hero-slider .carousel-item,
        .hero-slide-img {
            height: 520px;
        }

        .hero-caption {
            left: 8%;
            width: 70%;
        }

        .hero-caption h1 {
            font-size: 42px;
        }
    }


    /* =====================================
   MOBILE
===================================== */

    @media (max-width: 576px) {

        .hero-slider .carousel-item,
        .hero-slide-img {
            height: 480px;
        }

        .hero-caption {
            display: block !important;

            left: 7%;
            width: 86%;
        }

        .hero-caption h1 {
            font-size: 32px;
        }

        .hero-caption p {
            font-size: 14px;
            line-height: 1.6;
        }

        .hero-small {
            font-size: 13px;
        }

        .hero-buttons {
            flex-direction: column;
            align-items: flex-start;
        }

        .hero-btn-primary,
        .hero-btn-outline {
            padding: 10px 20px;
            font-size: 14px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            display: none;
        }
    }
</style>
<section class="hero-slider">

    <div id="bakeryCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

        {{-- Indicators --}}
        <div class="carousel-indicators">

            <button type="button" data-bs-target="#bakeryCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1">
            </button>

            <button type="button" data-bs-target="#bakeryCarousel" data-bs-slide-to="1" aria-label="Slide 2">
            </button>

            <button type="button" data-bs-target="#bakeryCarousel" data-bs-slide-to="2" aria-label="Slide 3">
            </button>

        </div>


        {{-- Slides --}}
        <div class="carousel-inner">


            {{-- SLIDE 1 --}}
            <div class="carousel-item active" data-bs-interval="5000">

                <img src="{{ asset('images/slider/slide1.jpg') }}" class="d-block w-100 hero-slide-img"
                    alt="Fresh cakes at Kasthuri Bakes">

                <div class="hero-overlay"></div>

                <div class="carousel-caption hero-caption">

                    <span class="hero-small">
                        Welcome to Kasthuri Bakes
                    </span>

                    <h1>
                        Freshly Baked,
                        <span>Made With Love</span>
                    </h1>

                    <p>
                        Delicious cakes, pastries and bakery favourites
                        freshly prepared for every special moment.
                    </p>

                    <div class="hero-buttons">

                        <a href="#" class="btn hero-btn-primary">
                            Explore Products
                        </a>

                        <a href="#" class="btn hero-btn-outline">
                            Order Now
                        </a>

                    </div>

                </div>

            </div>


            {{-- SLIDE 2 --}}
            <div class="carousel-item" data-bs-interval="5000">

                <img src="{{ asset('images/slider/slide2.jpg') }}" class="d-block w-100 hero-slide-img"
                    alt="Birthday cakes">

                <div class="hero-overlay"></div>

                <div class="carousel-caption hero-caption">

                    <span class="hero-small">
                        Celebrate Your Special Day
                    </span>

                    <h1>
                        Cakes Made For
                        <span>Your Moments</span>
                    </h1>

                    <p>
                        Birthday, anniversary or celebration —
                        make your special moments sweeter with us.
                    </p>

                    <a href="#" class="btn hero-btn-primary">
                        Order Your Cake
                    </a>

                </div>

            </div>


            {{-- SLIDE 3 --}}
            <div class="carousel-item" data-bs-interval="5000">

                <img src="{{ asset('images/slider/slide3.jpg') }}" class="d-block w-100 hero-slide-img"
                    alt="Fresh bakery snacks">

                <div class="hero-overlay"></div>

                <div class="carousel-caption hero-caption">

                    <span class="hero-small">
                        Fresh Every Day
                    </span>

                    <h1>
                        Taste The
                        <span>Freshness</span>
                    </h1>

                    <p>
                        From crispy snacks to freshly baked treats,
                        there's something delicious waiting for you.
                    </p>

                    <a href="#" class="btn hero-btn-primary">
                        View Products
                    </a>

                </div>

            </div>

        </div>


        {{-- Previous --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#bakeryCarousel" data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

            <span class="visually-hidden">
                Previous
            </span>

        </button>


        {{-- Next --}}
        <button class="carousel-control-next" type="button" data-bs-target="#bakeryCarousel" data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

            <span class="visually-hidden">
                Next
            </span>

        </button>

    </div>

</section>
