<style>
    .bakery-navbar {
        background: #FFF8F0;
        border-bottom: 1px solid #F0E4CC;
        position: sticky;
        top: 0;
        z-index: 500;
        box-shadow: 0 2px 12px rgba(44, 24, 16, 0.07);
    }

    .navbar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
        max-width: 1200px;
        margin: 0 auto;
        height: 68px;
    }

    /* ── Brand ── */
    .navbar-brand-link {
        font-family: 'Fraunces', serif;
        font-size: 24px;
        font-weight: 500;
        color: #8B4513;
        text-decoration: none;
        letter-spacing: 0.3px;
        line-height: 1;
    }

    .navbar-brand-link small {
        display: block;
        font-family: 'Work Sans', sans-serif;
        font-size: 10px;
        font-weight: 500;
        color: #B8A489;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-top: 1px;
    }

    /* ── Nav links ── */
    .nav-links {
        display: flex;
        align-items: center;
        gap: 2px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-links .nav-link {
        position: relative;
        font-family: 'Work Sans', sans-serif;
        color: #2C1810;
        font-size: 14.5px;
        font-weight: 500;
        padding: 8px 14px;
        text-decoration: none;
        transition: color 0.2s;
        border-radius: 6px;
    }

    .nav-links .nav-link:hover {
        color: #8B4513;
    }

    .nav-links .nav-link::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 2px;
        width: 0;
        height: 2px;
        background: #F4C430;
        transform: translateX(-50%);
        transition: width 0.25s ease;
        border-radius: 2px;
    }

    .nav-links .nav-link:hover::after,
    .nav-links .nav-link.active::after {
        width: 55%;
    }

    .nav-links .nav-link.active {
        color: #8B4513;
    }

    /* ── Dropdown ── */
    .nav-links .dropdown {
        position: relative;
    }

    .nav-links .dropdown-toggle::after {
        display: none;
    }

    .nav-links .dropdown-toggle .chevron {
        font-size: 10px;
        margin-left: 4px;
        transition: transform 0.2s;
    }

    .nav-links .dropdown:hover .chevron {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        min-width: 180px;
        background: #FFF8F0;
        border: 1px solid #F0E4CC;
        border-radius: 10px;
        padding: 6px;
        box-shadow: 0 8px 24px rgba(44, 24, 16, 0.12);
        z-index: 100;
    }

    .nav-links .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu .dropdown-item {
        font-family: 'Work Sans', sans-serif;
        color: #2C1810;
        font-size: 13.5px;
        padding: 9px 14px;
        border-radius: 6px;
        text-decoration: none;
        display: block;
        transition: background 0.15s;
    }

    .dropdown-menu .dropdown-item:hover {
        background: #8B4513;
        color: #fff;
    }

    /* ── Auth button ── */
    .btn-nav-login {
        font-family: 'Work Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 8px;
        background: #B23A48;
        color: #fff;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background 0.15s;
        margin-left: 8px;
    }

    .btn-nav-login:hover {
        background: #98303D;
        color: #fff;
    }

    /* ── Hamburger ── */
    .hamburger {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        background: none;
        border: none;
        padding: 4px;
    }

    .hamburger span {
        display: block;
        width: 24px;
        height: 2px;
        background: #2C1810;
        border-radius: 2px;
        transition: all 0.25s;
    }

    /* ── Mobile ── */
    @media (max-width: 768px) {
        .hamburger {
            display: flex;
        }

        .nav-links {
            display: none;
            flex-direction: column;
            align-items: flex-start;
            gap: 0;
            position: absolute;
            top: 68px;
            left: 0;
            right: 0;
            background: #FFF8F0;
            border-top: 1px solid #F0E4CC;
            padding: 12px 16px 20px;
            box-shadow: 0 8px 20px rgba(44, 24, 16, 0.1);
        }

        .nav-links.open {
            display: flex;
        }

        .nav-links .nav-link {
            padding: 10px 8px;
            width: 100%;
        }

        .nav-links .nav-link::after {
            display: none;
        }

        .dropdown-menu {
            position: static;
            box-shadow: none;
            border: none;
            background: #FFF0E0;
            padding: 4px 8px;
            margin-top: 4px;
        }

        .nav-links .dropdown:hover .dropdown-menu {
            display: none;
        }

        .nav-links .dropdown.open .dropdown-menu {
            display: block;
        }

        .btn-nav-login {
            margin: 10px 8px 0;
        }
    }
</style>

<header class="bakery-navbar">
    <div class="navbar-inner">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="navbar-brand-link">
            {{ config('app.name', 'Millhouse Bakery') }}
            <small>Fresh from the oven</small>
        </a>

        {{-- Hamburger --}}
        <button class="hamburger" id="hamburger" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>

        {{-- Links --}}
        <ul class="nav-links" id="navLinks">

            <li>
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link dropdown-toggle">
                    Products <span class="chevron">&#9660;</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/cakes">Cakes</a></li>
                    <li><a class="dropdown-item" href="/cupcakes">Cupcakes</a></li>
                    <li><a class="dropdown-item" href="/cookies">Cookies & Biscuits</a></li>
                    <li><a class="dropdown-item" href="/breads">Breads & Pastries</a></li>
                    <li><a class="dropdown-item" href="/donets&deserts">Donuts & Desserts</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('gallery.public') }}"
                    class="nav-link {{ request()->routeIs('gallery.public') ? 'active' : '' }}">Gallery</a>
            </li>

            <li>
                <a href="{{ route('about') }}"
                    class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            </li>

            <li>
                <a href="{{ route('contact') }}"
                    class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </li>

            {{-- Auth --}}
            @auth
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-nav-login">Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="btn-nav-login">Login</a>
                </li>
            @endauth

        </ul>
    </div>
</header>

<script>
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');

    hamburger.addEventListener('click', () => navLinks.classList.toggle('open'));

    // Mobile dropdown toggle
    document.querySelectorAll('.nav-links .dropdown .dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', e => {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                toggle.closest('.dropdown').classList.toggle('open');
            }
        });
    });
</script>
