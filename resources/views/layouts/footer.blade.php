<style>
    /* ========================================
   KASTHURI BAKES - FOOTER
======================================== */

    .bakery-footer {
        background: #2c1810;
        color: #fff8f0;
        padding: 60px 0 20px;
        font-family: "Open Sans", sans-serif;
    }

    /* Logo */

    .footer-logo {
        font-family: "Poppins", sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 18px;
    }

    .footer-logo span {
        color: #f4c430;
    }

    .footer-description {
        color: #d8cbc5;
        font-size: 14px;
        line-height: 1.8;
        max-width: 340px;
    }

    /* Footer Titles */

    .footer-title {
        font-family: "Poppins", sans-serif;
        color: #f4c430;
        font-size: 17px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    /* Links */

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 10px;
    }

    .footer-links a {
        color: #d8cbc5;
        text-decoration: none;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .footer-links a:hover {
        color: #f4c430;
        padding-left: 5px;
    }

    /* Social Icons */

    .footer-social {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .footer-social a {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #8b4513;
        color: #ffffff;

        text-decoration: none;

        transition: 0.3s ease;
    }

    .footer-social a:hover {
        background: #f4c430;
        color: #2c1810;
        transform: translateY(-3px);
    }

    /* Contact */

    .footer-contact p {
        display: flex;
        align-items: flex-start;
        gap: 12px;

        color: #d8cbc5;
        font-size: 14px;

        margin-bottom: 14px;
    }

    .footer-contact i {
        color: #f4c430;
        margin-top: 4px;
        width: 16px;
    }

    .footer-contact a {
        color: #d8cbc5;
        text-decoration: none;
    }

    .footer-contact a:hover {
        color: #f4c430;
    }

    /* Bottom */

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.12);

        margin-top: 45px;
        padding-top: 20px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        color: #bcaea8;
        font-size: 13px;
    }

    .footer-bottom p {
        margin: 0;
    }

    .developer-credit i {
        color: #f4c430;
        margin: 0 3px;
    }

    /* ========================================
   RESPONSIVE
======================================== */

    @media (max-width: 768px) {
        .bakery-footer {
            padding-top: 45px;
        }

        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
<footer class="bakery-footer">

    <div class="container">
        <div class="row gy-4">

            {{-- Bakery Info --}}
            <div class="col-lg-4 col-md-6">
                <h3 class="footer-logo">
                    {{-- Kasthuri  --}}
                    <span>Bakes</span>
                </h3>

                <p class="footer-description">
                    Freshly baked with love every day. Enjoy delicious cakes,
                    snacks and bakery favourites in Sathyamangalam.
                </p>

                {{-- Social Media --}}
                <div class="footer-social">
                    <a href="#" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="#" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="#" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>


            {{-- Quick Links --}}
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Quick Links</h5>

                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('gallery.public') }}">Gallery</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>


            {{-- Products --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Our Products</h5>

                <ul class="footer-links">
                    <li><a href="#">Birthday Cakes</a></li>
                    <li><a href="#">Custom Cakes</a></li>
                    <li><a href="#">Pastries</a></li>
                    <li><a href="#">Cookies & Biscuits</a></li>
                    <li><a href="#">Snacks & Puffs</a></li>
                </ul>
            </div>


            {{-- Contact --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Contact Us</h5>

                <div class="footer-contact">

                    <p>
                        <i class="fas fa-location-dot"></i>
                        <span>
                            {{-- Kasthuri Bakes, --}}
                            <br>
                            Sathyamangalam,<br>
                            Tamil Nadu
                        </span>
                    </p>

                    <p>
                        <i class="fas fa-phone"></i>
                        <a href="tel:+91XXXXXXXXXX">
                            +91 XXXXX XXXXX
                        </a>
                    </p>

                    <p>
                        <i class="fab fa-whatsapp"></i>
                        <a href="#">
                            WhatsApp Us
                        </a>
                    </p>

                    <p>
                        <i class="fas fa-clock"></i>
                        <span>Open Daily</span>
                    </p>

                </div>
            </div>

        </div>


        {{-- Bottom Footer --}}
        <div class="footer-bottom">

            <p>
                &copy; {{ date('Y') }} Kasthuri Bakes.
                All Rights Reserved.
            </p>

            <p class="developer-credit">
                Designed & Developed with
                <i class="fas fa-heart"></i>
                by Gokul K
            </p>

        </div>

    </div>

</footer>
