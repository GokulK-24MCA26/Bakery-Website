@extends('layouts.app')

@section('title', 'Gallery — ' . config('app.name'))

@push('styles')
<style>
    .gallery-hero {
        background: linear-gradient(135deg, #2B1B14 0%, #4a2c1a 100%);
        padding: 70px 0 50px; text-align: center;
    }
    .gallery-hero h1 {
        font-family: 'Fraunces', serif;
        font-size: 44px; font-weight: 500; color: #F6E9D3; margin-bottom: 12px;
    }
    .gallery-hero p { color: #B8A489; font-size: 15px; max-width: 460px; margin: 0 auto; }

    .gallery-section { padding: 60px 0; background: #FBF3E4; }

    /* Filter tabs */
    .filter-tabs {
        display: flex; justify-content: center;
        flex-wrap: wrap; gap: 8px; margin-bottom: 40px;
    }
    .filter-btn {
        padding: 7px 20px; border-radius: 20px;
        border: 1.5px solid #E6D8BF;
        background: #fff; color: #8A7460;
        font-family: 'Work Sans', sans-serif;
        font-size: 13.5px; font-weight: 500;
        cursor: pointer; transition: all .2s;
    }
    .filter-btn:hover, .filter-btn.active {
        background: #B23A48; border-color: #B23A48; color: #fff;
    }

    /* Masonry grid */
    .gallery-grid { columns: 4; column-gap: 14px; }
    .gallery-item {
        break-inside: avoid; margin-bottom: 14px;
        border-radius: 12px; overflow: hidden;
        position: relative; cursor: pointer;
        transition: transform .2s;
    }
    .gallery-item:hover { transform: scale(1.02); }
    .gallery-item img { width: 100%; display: block; }
    .gallery-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(43,27,20,0.8) 0%, transparent 55%);
        opacity: 0; transition: opacity .25s;
        display: flex; align-items: flex-end; padding: 14px;
    }
    .gallery-item:hover .gallery-overlay { opacity: 1; }
    .gallery-overlay span { color: #F6E9D3; font-size: 13px; font-weight: 500; }
    .gallery-tag-dot {
        position: absolute; top: 10px; right: 10px;
        padding: 3px 10px; border-radius: 20px;
        font-size: 11px; font-weight: 600;
        text-transform: capitalize; backdrop-filter: blur(4px);
    }
    .dot-products          { background:rgba(254,243,226,0.9); color:#C98B2E; }
    .dot-events            { background:rgba(232,245,233,0.9); color:#388E3C; }
    .dot-behind-the-scenes { background:rgba(237,231,246,0.9); color:#5E35B1; }
    .dot-seasonal          { background:rgba(253,232,235,0.9); color:#B23A48; }

    @media (max-width: 992px) { .gallery-grid { columns: 3; } }
    @media (max-width: 640px) { .gallery-grid { columns: 2; } }
    @media (max-width: 400px) { .gallery-grid { columns: 1; } }

    /* Lightbox */
    .lightbox {
        display: none; position: fixed; inset: 0;
        background: rgba(20,10,6,0.93);
        z-index: 9999; align-items: center; justify-content: center;
        flex-direction: column; gap: 16px;
    }
    .lightbox.open { display: flex; }
    .lightbox-img {
        max-width: 88vw; max-height: 80vh;
        border-radius: 10px;
        box-shadow: 0 24px 60px rgba(0,0,0,0.5);
        object-fit: contain;
    }
    .lightbox-close {
        position: absolute; top: 20px; right: 28px;
        color: #F6E9D3; font-size: 32px;
        cursor: pointer; background: none; border: none; line-height: 1;
    }
    .lightbox-caption { color: #F6E9D3; font-size: 14px; text-align: center; }
    .lightbox-tag {
        font-size: 11.5px; font-weight: 600;
        padding: 3px 12px; border-radius: 20px;
        background: rgba(178,58,72,0.3); color: #F6E9D3;
        text-transform: capitalize;
    }
</style>
@endpush

@section('content')

<section class="gallery-hero">
    <div class="container">
        <h1>Our Gallery</h1>
        <p>A peek into our bakery — fresh bakes, events, behind the scenes & more.</p>
    </div>
</section>

<section class="gallery-section">
    <div class="container">

        {{-- Filter tabs --}}
        <div class="filter-tabs">
            <button class="filter-btn active" data-filter="all">All</button>
            @foreach($items->keys() as $tag)
                <button class="filter-btn" data-filter="{{ $tag }}">
                    {{ ucwords(str_replace('-', ' ', $tag)) }}
                </button>
            @endforeach
        </div>

        {{-- Grid --}}
        @if($items->isEmpty())
            <p style="text-align:center;color:#8A7460;padding:40px 0;">No photos yet. Check back soon!</p>
        @else
        <div class="gallery-grid">
            @foreach($items as $tag => $photos)
                @foreach($photos as $photo)
                <div class="gallery-item" data-tag="{{ $tag }}"
                     onclick="openLightbox('{{ asset('storage/' . $photo->image) }}', '{{ $photo->title }}', '{{ $tag }}')">
                    <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" loading="lazy">
                    <div class="gallery-overlay">
                        <span>{{ $photo->title }}</span>
                    </div>
                    <span class="gallery-tag-dot dot-{{ $tag }}">
                        {{ ucwords(str_replace('-', ' ', $tag)) }}
                    </span>
                </div>
                @endforeach
            @endforeach
        </div>
        @endif

    </div>
</section>

{{-- Lightbox --}}
<div class="lightbox" id="lightbox" onclick="closeLightbox(event)">
    <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="">
    <div style="text-align:center;">
        <div class="lightbox-caption" id="lightboxCaption"></div>
        <span class="lightbox-tag" id="lightboxTag"></span>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Filter
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const filter = btn.dataset.filter;
            document.querySelectorAll('.gallery-item').forEach(item => {
                item.style.display = (filter === 'all' || item.dataset.tag === filter) ? 'block' : 'none';
            });
        });
    });

    // Lightbox
    function openLightbox(src, caption, tag) {
        document.getElementById('lightboxImg').src = src;
        document.getElementById('lightboxCaption').textContent = caption;
        document.getElementById('lightboxTag').textContent = tag.replace(/-/g, ' ');
        document.getElementById('lightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(e) {
        if (e && e.target !== document.getElementById('lightbox') && !e.target.classList.contains('lightbox-close')) return;
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => { if (e.key === 'Escape') { document.getElementById('lightbox').classList.remove('open'); document.body.style.overflow = ''; } });
</script>
@endpush
