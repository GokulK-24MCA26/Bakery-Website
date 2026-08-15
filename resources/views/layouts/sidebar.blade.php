<!-- Mobile toggle button: only visible on small screens -->
<button id="sidebarToggle" class="sidebar-toggle" aria-label="Toggle sidebar" aria-controls="sidebar" aria-expanded="false">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- Overlay: dims the page and closes the sidebar when tapped -->
<div id="sidebarOverlay" class="sidebar-overlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        {{ config('app.name', 'Millhouse Bakery') }}
        <small>Admin Panel</small>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Main</div>
        <a href="{{ route('admin.dashboard') }}"
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>

        <div class="nav-label mt-2">Manage</div>
        <a href="{{ route('categories.index') }}"
            class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="fa-solid fa-tags"></i> Categories
        </a>
        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="fa-solid fa-bread-slice"></i> Products
        </a>
        <a href="#" class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
            <i class="fa-solid fa-bag-shopping"></i> Orders
        </a>
        <a href="{{ route('gallery.index') }}"
           class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}">
            <i class="fa-solid fa-images"></i> Gallery
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ Auth::user()->role }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
            </button>
        </form>
    </div>
</aside>

<style>
    /* Toggle button: hidden on desktop, shown on mobile */
    .sidebar-toggle {
        display: none;
        position: fixed;
        top: 14px;
        left: 14px;
        z-index: 1050;
        width: 40px;
        height: 40px;
        border: none;
        border-radius: 8px;
        background: var(--jam, #B23A48);
        color: #fff;
        font-size: 16px;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* Overlay behind the sidebar on mobile */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        z-index: 1030;
    }

    .sidebar-overlay.show {
        display: block;
    }

    @media (max-width: 991.98px) {
        .sidebar-toggle {
            display: flex;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            max-width: 80vw;
            transform: translateX(-100%);
            transition: transform .25s ease;
            z-index: 1040;
            overflow-y: auto;
        }

        .sidebar.active {
            transform: translateX(0);
        }
    }
</style>

<script>
    (function() {
        var toggle = document.getElementById('sidebarToggle');
        var sidebar = document.getElementById('sidebar');
        var overlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.add('active');
            overlay.classList.add('show');
            toggle.setAttribute('aria-expanded', 'true');
        }

        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');
        }

        toggle.addEventListener('click', function() {
            sidebar.classList.contains('active') ? closeSidebar() : openSidebar();
        });

        overlay.addEventListener('click', closeSidebar);

        // Close the sidebar after tapping a nav link on mobile
        sidebar.querySelectorAll('.nav-link').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 991.98) closeSidebar();
            });
        });

        // Reset state if the viewport is resized back to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 991.98) closeSidebar();
        });
    })();
</script>
