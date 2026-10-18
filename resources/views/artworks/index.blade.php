@extends('layouts.app')

@section('title', 'Gallery | Art Gallery')

@section('content')

<style>
    .gallery-page {
        background:
            radial-gradient(ellipse at top, #f8f1e3 0%, #eee3cf 55%, #e4d4b9 100%);
        min-height: 100vh;
        padding: 75px 0;
        overflow: hidden;
    }

    .gallery-label {
        color: #a88746;
        font-size: 11px;
        letter-spacing: 4px;
        font-weight: 600;
    }

    .gallery-title {
        color: #30261b;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(42px, 6vw, 68px);
        font-weight: normal;
        margin: 18px 0;
    }

    .gallery-description {
        color: #776b5b;
        max-width: 520px;
        line-height: 1.9;
        margin: 0 auto;
        font-size: 15px;
    }

    .gold-divider {
        width: 65px;
        height: 2px;
        background: #b89a5a;
        margin: 25px auto;
    }

    .gallery-counter {
        color: #88775d;
        font-size: 11px;
        letter-spacing: 2px;
    }

    /* MUSEUM WALL */
    .museum-wall {
        position: relative;
        padding: 32px 22px;
        background:
            linear-gradient(90deg,
                rgba(125, 91, 46, .04),
                transparent 12%,
                transparent 88%,
                rgba(125, 91, 46, .04)),
            #eee2cc;
        border-top: 1px solid rgba(160, 124, 67, .25);
        border-bottom: 5px solid #c8ae83;
        box-shadow:
            inset 0 0 35px rgba(100, 72, 37, .07),
            0 8px 20px rgba(73, 51, 25, .06);
    }

    /* FRAME CARD */
    .art-card {
        position: relative;
        height: 100%;
        padding: 11px;
        background: linear-gradient(
            135deg,
            #e4cb8d 0%,
            #a77c34 18%,
            #f6e6b6 32%,
            #b58a43 52%,
            #f0d99b 70%,
            #96702f 100%
        );
        border: 1px solid #9a7539;
        box-shadow:
            0 5px 8px rgba(53, 36, 16, .15),
            0 12px 22px rgba(53, 36, 16, .12);
        transition:
            transform .35s ease,
            box-shadow .35s ease;
        transform: translateY(0) scale(1);
        transform-origin: center;
        z-index: 1;
        opacity: 0;
        animation: museumReveal .8s cubic-bezier(.2, .7, .2, 1) forwards;
    }

    /* Alternating entrances: left, right, left, right... */
    .art-column:nth-child(odd) .art-card {
        animation-name: enterFromLeft;
    }

    .art-column:nth-child(even) .art-card {
        animation-name: enterFromRight;
    }

    .art-column:nth-child(1) .art-card { animation-delay: .08s; }
    .art-column:nth-child(2) .art-card { animation-delay: .22s; }
    .art-column:nth-child(3) .art-card { animation-delay: .36s; }
    .art-column:nth-child(4) .art-card { animation-delay: .12s; }
    .art-column:nth-child(5) .art-card { animation-delay: .26s; }
    .art-column:nth-child(6) .art-card { animation-delay: .40s; }

    .art-card:hover {
        transform: translateY(-10px) scale(1.035);
        box-shadow:
            0 8px 12px rgba(53, 36, 16, .18),
            0 24px 38px rgba(53, 36, 16, .23);
        z-index: 10;
    }

    /* Inner gold bevel */
    .frame-inner {
        padding: 7px;
        background: linear-gradient(
            135deg,
            #9e783b,
            #f7e7b9 25%,
            #c29a50 55%,
            #f1d99d 75%,
            #977037
        );
    }

    .art-image-wrapper {
        position: relative;
        overflow: hidden;
        background: #e5d8bf;
        border: 4px solid #f4e8cb;
    }

    .art-image-link {
        display: block;
        overflow: hidden;
        outline-offset: 4px;
    }

    .art-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
        transition: transform .65s cubic-bezier(.2, .7, .2, 1);
    }

    .art-card:hover .art-image {
        transform: scale(1.075);
    }

    .art-number {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(250, 244, 228, .94);
        color: #8c713d;
        font-size: 9px;
        letter-spacing: 2px;
        padding: 7px 9px;
        z-index: 2;
        pointer-events: none;
    }

    .art-info {
        background: #f8f0df;
        padding: 21px 18px 20px;
        border-top: 1px solid #d7bd83;
        min-height: 235px;
    }

    .art-category {
        color: #9b783d;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 9px;
        line-height: 1.7;
        margin-bottom: 10px;
        overflow-wrap: anywhere;
    }

    .art-title {
        color: #30271d;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 22px;
        line-height: 1.35;
        font-weight: normal;
        margin-bottom: 8px;
        overflow-wrap: anywhere;
    }

    .art-artist {
        color: #84735b;
        font-size: 13px;
        font-style: italic;
        margin-bottom: 18px;
    }

    .art-details {
        border-top: 1px solid #e4d6ba;
        padding-top: 13px;
        color: #786d5d;
        font-size: 11px;
    }

    .art-price {
        color: #92713a;
        font-size: 15px;
        font-weight: 600;
        margin-top: 16px;
        margin-bottom: 0;
    }

    .art-card::after {
        content: "";
        position: absolute;
        inset: 3px;
        border: 1px solid rgba(255, 245, 214, .65);
        pointer-events: none;
        z-index: 3;
    }

    .gallery-empty {
        padding: 70px 20px;
        text-align: center;
        color: #81796e;
        background: #f8f0df;
        border: 1px solid #c8ae83;
    }

    /* PAGINATION */
    .pagination {
        margin-bottom: 0;
        gap: 5px;
    }

    .page-link {
        color: #88672f;
        background: #f8f0df;
        border-color: #d5c19b;
        border-radius: 0 !important;
        padding: 10px 15px;
        transition: .25s ease;
    }

    .page-link:hover {
        color: #fff8e8;
        background: #a88746;
        border-color: #a88746;
    }

    .page-item.active .page-link {
        background: #a88746;
        border-color: #a88746;
        color: #fff8e8;
    }

    .page-item.disabled .page-link {
        background: #eee2cc;
        color: #ad9d81;
        border-color: #d5c19b;
    }

    @keyframes enterFromLeft {
        from {
            opacity: 0;
            transform: translateX(-65px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes enterFromRight {
        from {
            opacity: 0;
            transform: translateX(65px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes museumReveal {
        from {
            opacity: 0;
            transform: translateY(25px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 767px) {
        .gallery-page {
            padding: 48px 0;
        }

        .museum-wall {
            padding: 20px 13px;
        }

        .art-image {
            height: 280px;
        }

        .art-title {
            font-size: 21px;
        }

        .art-info {
            min-height: auto;
        }

        .art-card:hover {
            transform: translateY(-5px) scale(1.015);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .art-card,
        .art-image {
            animation: none !important;
            opacity: 1;
            transition: none;
        }
    }
</style>

<div class="gallery-page">
    <div class="container">

        {{-- HEADER --}}
        <div class="text-center mb-5">
            <p class="gallery-label mb-0">
                A CURATED COLLECTION
            </p>

            <h1 class="gallery-title">
                Discover the Art
            </h1>

            <div class="gold-divider"></div>

            <p class="gallery-description">
                Step into a world of creativity, beauty, and timeless
                expression through our carefully curated collection
                of extraordinary artworks.
            </p>
        </div>

        {{-- COLLECTION COUNTER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="gallery-counter mb-0">
                OUR COLLECTION
            </p>

            <p class="gallery-counter mb-0">
                {{ $artworks->count() }} ARTWORKS ON THIS PAGE
            </p>
        </div>

        {{-- MUSEUM WALL --}}
        <div class="museum-wall">
            <div class="row g-4">

                @forelse ($artworks as $artwork)
                    <div class="col-sm-6 col-lg-4 art-column">
                        <article class="art-card">

                            <div class="frame-inner">
                                <div class="art-image-wrapper">

                                    <span class="art-number">
                                        NO. {{ str_pad($artwork->id, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                    <a
                                        href="{{ route('artworks.show', $artwork->id) }}"
                                        class="art-image-link"
                                        aria-label="View details of {{ $artwork->title }}"
                                    >
                                        <img
                                            src="{{ asset('assets/images/' . $artwork->image) }}"
                                            class="art-image"
                                            alt="{{ $artwork->title }}"
                                            loading="lazy"
                                        >
                                    </a>

                                </div>
                            </div>

                            <div class="art-info">
                                <p class="art-category">
                                    {{ $artwork->medium }}
                                </p>

                                <h2 class="art-title">
                                    {{ $artwork->title }}
                                </h2>

                                <p class="art-artist">
                                    By {{ $artwork->artist }}
                                </p>

                                <div class="art-details">
                                    <div class="d-flex justify-content-between gap-2">
                                        <span>Year</span>
                                        <span>{{ $artwork->year }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between gap-2 mt-2">
                                        <span>Medium</span>
                                        <span class="text-end">{{ $artwork->medium }}</span>
                                    </div>
                                </div>

                                <p class="art-price">
                                    Rp {{ number_format($artwork->price, 0, ',', '.') }}
                                </p>
                            </div>

                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="gallery-empty">
                            <h3 class="h4" style="font-family: Georgia, serif;">
                                The Gallery Awaits
                            </h3>

                            <p class="mb-0 mt-3">
                                No artworks are currently available.
                            </p>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $artworks->links('pagination::bootstrap-5') }}
        </div>

        {{-- FOOTER --}}
        <div class="text-center mt-5 pt-3">
            <div class="gold-divider"></div>

            <p class="gallery-label mb-0">
                EVERY ARTWORK TELLS A STORY
            </p>
        </div>

    </div>
</div>

@endsection

