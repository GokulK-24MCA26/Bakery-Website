<style>
    .kb-gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .kb-gallery-item {
        border-radius: 14px;
        overflow: hidden;
        height: 220px;
        display: block;
    }

    .kb-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Premium clarity */
        filter: brightness(1.07) contrast(1.07) saturate(1.14);
        image-rendering: -webkit-optimize-contrast;
        backface-visibility: hidden;
        transform: translateZ(0);
        transition: transform .45s ease, filter .3s ease;
    }

    .kb-gallery-item:hover img {
        transform: scale(1.09);
        filter: brightness(1.12) contrast(1.08) saturate(1.18);
    }

    @media (max-width: 767.98px) {
        .kb-gallery-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .kb-gallery-item { height: 140px; }
    }
</style>

<section class="kb-section">
    <div class="container">
        <div class="kb-section-head">
            <span class="kb-section-eyebrow">Gallery</span>
            <h2 class="kb-section-title">Straight From Our Oven</h2>
            <p class="kb-section-sub">A peek at our latest creations.</p>
        </div>

        <div class="kb-gallery-grid mb-5">
            @forelse ($galleryImages as $image)
                <a href="{{ asset('storage/' . $image->image) }}" target="_blank" rel="noopener" class="kb-gallery-item">
                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->title ?? 'Bakery creation' }}" loading="lazy">
                </a>
            @empty
                <div class="col-12 text-center" style="color:#8A7460;">Photos coming soon!</div>
            @endforelse
        </div>

        <div class="text-center">
            <a href="{{ route('gallery.public') }}" class="btn-kb-outline" style="border-color:#2C1810;color:#2C1810;">
                View Full Gallery <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
