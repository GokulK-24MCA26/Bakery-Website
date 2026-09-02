/* ============================================================
   GMS WEB STUDIO BAKERY - Shared site scripts
   Loaded on every public page via layouts/app.blade.php
   ============================================================ */

document.addEventListener('DOMContentLoaded', function () {

    /* --------------------------------------------------------
       SKELETON LOADING
    -------------------------------------------------------- */

    var skeleton = document.getElementById('pageSkeleton');

    // Hide the skeleton once the page (including images) is ready
    function hideSkeleton() {
        if (!skeleton || skeleton.classList.contains('is-done')) return;
        skeleton.classList.add('is-done');
    }

    if (document.readyState === 'complete') {
        hideSkeleton();
    } else {
        window.addEventListener('load', hideSkeleton);
    }

    // Failsafe: never trap the user behind the skeleton
    setTimeout(hideSkeleton, 4000);

    // Browser back/forward cache restore
    window.addEventListener('pageshow', function (e) {
        if (e.persisted) hideSkeleton();
    });

    // Show skeleton again while navigating to another internal page
    function showSkeleton() {
        if (skeleton) skeleton.classList.remove('is-done');
    }

    document.addEventListener('click', function (e) {
        if (e.defaultPrevented || e.button !== 0) return;
        if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

        var link = e.target.closest('a');
        if (!link) return;

        var href = link.getAttribute('href');
        if (!href || href === '#' || href.charAt(0) === '#') return;
        if (link.target === '_blank' || link.hasAttribute('download')) return;

        var url = new URL(link.href, window.location.href);
        if (url.origin !== window.location.origin) return;
        if (url.pathname === window.location.pathname &&
            url.search === window.location.search) return;

        showSkeleton();
    });

    // Show skeleton while forms submit (login, register, contact, orders)
    document.addEventListener('submit', function () {
        showSkeleton();
    });

    /* --------------------------------------------------------
       IMAGE SKELETONS
       Adds a shimmer placeholder to every content image until it
       has actually finished loading.
    -------------------------------------------------------- */

    document.querySelectorAll('main img').forEach(function (img) {
        function loaded() { img.classList.remove('img-loading'); }

        if (!img.complete || img.naturalWidth === 0) {
            img.classList.add('img-loading');
            img.addEventListener('load', loaded);
            img.addEventListener('error', loaded);
        }
    });

    /* --------------------------------------------------------
       FLASH MESSAGES
    -------------------------------------------------------- */

    // Auto-hide flash messages after 4 seconds
    document.querySelectorAll('[data-auto-dismiss]').forEach(function (el) {
        setTimeout(function () {
            el.style.transition = 'opacity .4s ease';
            el.style.opacity = '0';
            setTimeout(function () { el.remove(); }, 400);
        }, 4000);
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(function (link) {
        link.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

});
