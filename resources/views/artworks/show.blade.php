<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $artwork->title }} | Art Gallery</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(ellipse at top, #f8f0dd 0%, #e9dfc9 55%, #d5c4a5 100%);
            color: #453626;
            font-family: Georgia, 'Times New Roman', serif;
            overflow-x: hidden;
        }

        .gallery-header {
            text-align: center;
            padding: 42px 15px 10px;
            animation: fadeDown 1s ease both;
        }

        .gallery-header .small-title {
            font-size: 11px;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: #9a773c;
        }

        .gallery-header h1 {
            font-size: clamp(25px, 4vw, 39px);
            font-weight: normal;
            margin: 12px 0;
            letter-spacing: 1px;
        }

        .gallery-header p {
            font-size: 13px;
            color: #8a7963;
            font-style: italic;
        }

        .book-stage {
            width: min(1100px, 94%);
            margin: 35px auto 25px;
            perspective: 2200px;
            animation: bookAppear 1s ease both;
        }

        .book {
            display: grid;
            grid-template-columns: 1fr 1fr;
            position: relative;
            transform-style: preserve-3d;
            filter: drop-shadow(0 25px 22px rgba(64, 43, 20, .20));
        }

        .book::before {
            content: "";
            position: absolute;
            z-index: 5;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 24px;
            transform: translateX(-50%);
            background: linear-gradient(
                90deg,
                rgba(83, 57, 29, .18),
                rgba(255, 250, 230, .7) 45%,
                rgba(95, 66, 35, .20)
            );
            pointer-events: none;
        }

        .page {
            min-width: 0;
            min-height: 660px;
            position: relative;
            padding: 42px;
            overflow: hidden;
            background-color: #f8f0dc;
            background-image:
                radial-gradient(ellipse at 15% 20%, rgba(167, 129, 69, .08), transparent 40%),
                radial-gradient(ellipse at 90% 80%, rgba(167, 129, 69, .07), transparent 40%),
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 4px,
                    rgba(115, 86, 48, .018) 5px
                );
            border: 1px solid #d5c19a;
        }

        .left-page {
            border-radius: 5px 0 0 5px;
            transform-origin: right center;
            animation: leftPageOpen 1.1s ease-out both;
        }

        .right-page {
            border-radius: 0 5px 5px 0;
            transform-origin: left center;
            animation: rightPageOpen 1.1s ease-out both;
        }

        .page::after {
            content: "";
            position: absolute;
            inset: 12px;
            border: 1px solid rgba(169, 132, 69, .35);
            pointer-events: none;
        }

        .page-content {
            position: relative;
            z-index: 1;
        }

        .page-kicker {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #9a773c;
            margin-bottom: 18px;
        }

        .artwork-frame {
            padding: 9px;
            background: #fff9e9;
            border: 1px solid #c9ad75;
            box-shadow: 0 8px 20px rgba(75, 52, 26, .15);
        }

        .artwork-image {
            display: block;
            width: 100%;
            height: 360px;
            object-fit: contain;
            background: #e8dfcb;
        }

        .artwork-caption {
            text-align: center;
            padding-top: 22px;
        }

        .artwork-caption h2 {
            font-size: clamp(20px, 2.5vw, 27px);
            font-weight: normal;
            line-height: 1.3;
            margin-bottom: 10px;
        }

        .artwork-caption p {
            color: #8d744f;
            font-size: 13px;
            font-style: italic;
        }

        .ornament {
            text-align: center;
            color: #b28a45;
            font-size: 19px;
            margin: 13px 0;
        }

        .story-title {
            font-size: clamp(27px, 3vw, 36px);
            font-weight: normal;
            line-height: 1.2;
            margin: 8px 0 15px;
            color: #5b432c;
        }

        .handwriting {
            font-family: "Segoe Print", "Bradley Hand", "Comic Sans MS", cursive;
            font-size: 15px;
            line-height: 2;
            color: #66523e;
            white-space: normal;
        }

        .story-content {
            animation: writingReveal 1.3s .6s ease both;
        }

        .metadata {
            margin-top: 25px;
            padding-top: 18px;
            border-top: 1px dashed #c4ad80;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 12px;
            animation: writingReveal 1.3s .9s ease both;
        }

        .meta-label {
            font-size: 9px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #a08045;
            margin-bottom: 6px;
        }

        .meta-value {
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .page-number {
            position: absolute;
            bottom: 25px;
            left: 0;
            right: 0;
            text-align: center;
            color: #a18b67;
            font-size: 11px;
            z-index: 2;
        }

        .book-actions {
            display: flex;
            justify-content: center;
            gap: 14px;
            margin: 28px auto 50px;
            flex-wrap: wrap;
            animation: fadeDown 1s 1s ease both;
        }

        .book-button {
            display: inline-block;
            text-decoration: none;
            padding: 12px 23px;
            border: 1px solid #a9874d;
            color: #775a2d;
            background: rgba(255, 249, 233, .65);
            font-family: Georgia, serif;
            font-size: 13px;
            letter-spacing: 1px;
            transition: all .3s ease;
        }

        .book-button:hover {
            background: #9b793e;
            color: #fff9ec;
            transform: translateY(-2px);
        }

        .footer-note {
            text-align: center;
            padding: 0 15px 30px;
            font-size: 11px;
            letter-spacing: 2px;
            color: #917a59;
        }

        @keyframes bookAppear {
            from {
                opacity: 0;
                transform: translateY(45px) rotateX(5deg);
            }
            to {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }
        }

        @keyframes leftPageOpen {
            from {
                opacity: 0;
                transform: rotateY(18deg);
            }
            to {
                opacity: 1;
                transform: rotateY(0);
            }
        }

        @keyframes rightPageOpen {
            from {
                opacity: 0;
                transform: rotateY(-35deg);
            }
            to {
                opacity: 1;
                transform: rotateY(0);
            }
        }

        @keyframes writingReveal {
            from {
                opacity: 0;
                transform: translateY(-18px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 767px) {
            .gallery-header {
                padding-top: 28px;
            }

            .book-stage {
                width: 92%;
                margin-top: 20px;
            }

            .book {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .book::before {
                display: none;
            }

            .page {
                min-height: auto;
                padding: 30px 25px 55px;
            }

            .left-page {
                border-radius: 5px 5px 0 0;
            }

            .right-page {
                border-radius: 0 0 5px 5px;
                border-top: 0;
            }

            .artwork-image {
                height: 300px;
            }

            .story-title {
                font-size: 29px;
            }

            .handwriting {
                font-size: 14px;
            }

            .page-number {
                bottom: 17px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-delay: 0ms !important;
            }
        }
    </style>
</head>

<body>

    <header class="gallery-header">
        <div class="small-title">The Art Gallery Archives</div>
        <h1>A Journey Through Art</h1>
        <p>Every masterpiece holds a story.</p>
    </header>

    <main class="book-stage">
        <div class="book">

            <!-- LEFT PAGE: ARTWORK -->
            <section class="page left-page">
                <div class="page-content">

                    <div class="page-kicker">The Collection · No. {{ $artwork->id }}</div>

                    <div class="artwork-frame">
                        <img
                            src="{{ asset('assets/images/' . $artwork->image) }}"
                            alt="{{ $artwork->title }}"
                            class="artwork-image"
                        >
                    </div>

                    <div class="artwork-caption">
                        <h2>{{ $artwork->title }}</h2>

                        <div class="ornament">❦</div>

                        <p>{{ $artwork->artist }} · {{ $artwork->year }}</p>
                    </div>

                </div>

                <div class="page-number">— {{ $artwork->id }} —</div>
            </section>

            <!-- RIGHT PAGE: STORY -->
            <section class="page right-page">
                <div class="page-content">

                    <div class="page-kicker">An Artist's Journal</div>

                    <div class="story-content">
                        <h2 class="story-title">The Story Behind the Masterpiece</h2>

                        <div class="ornament" style="text-align: left;">✦ ─────</div>

                        <div class="handwriting">
                            {{ $history }}
                        </div>
                    </div>

                    <div class="metadata">
                        <div>
                            <div class="meta-label">Artist</div>
                            <div class="meta-value">{{ $artwork->artist }}</div>
                        </div>

                        <div>
                            <div class="meta-label">Year Created</div>
                            <div class="meta-value">{{ $artwork->year }}</div>
                        </div>

                        <div>
                            <div class="meta-label">Medium</div>
                            <div class="meta-value">{{ $artwork->medium }}</div>
                        </div>

                        <div>
                            <div class="meta-label">Estimated Value</div>
                            <div class="meta-value">
                                Rp {{ number_format($artwork->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="page-number">The Art Gallery Archives</div>
            </section>

        </div>
    </main>

    <div class="book-actions">
        <a href="{{ route('artworks.index') }}" class="book-button">
            ← Back to Gallery
        </a>
    </div>

    <footer class="footer-note">
        PRESERVING ART · CELEBRATING HISTORY · INSPIRING GENERATIONS
    </footer>

</body>
</html>
