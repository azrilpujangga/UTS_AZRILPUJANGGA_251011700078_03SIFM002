
@extends('layouts.app')

@section('title', 'About Us | Art Gallery')

@section('content')

<style>
    .about-page {
        --gold: #b89a5a;
        --gold-dark: #8d713d;
        --ink: #302b24;
        --muted: #777168;
        --paper: #faf8f3;
        color: var(--ink);
        background: var(--paper);
        overflow: hidden;
    }

    .about-page * {
        box-sizing: border-box;
    }

    /* ANIMATIONS */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes goldLine {
        from { width: 0; }
        to { width: 65px; }
    }

    @keyframes floatArt {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    .animate-up {
        animation: fadeUp .9s ease both;
    }

    .animate-down {
        animation: fadeDown .8s ease both;
    }

    .delay-1 { animation-delay: .15s; }
    .delay-2 { animation-delay: .3s; }
    .delay-3 { animation-delay: .45s; }

    .about-label {
        color: var(--gold-dark);
        font-size: 11px;
        letter-spacing: 4px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .about-divider {
        width: 65px;
        height: 2px;
        background: var(--gold);
        margin: 25px auto;
        animation: goldLine 1s ease both;
    }

    .about-title,
    .about-story-title,
    .about-section-title,
    .about-art-heading,
    .about-value-title {
        font-family: Georgia, 'Times New Roman', serif;
        font-weight: normal;
    }

    /* HERO */
    .about-hero {
        position: relative;
        padding: 95px 20px 85px;
        text-align: center;
        border-bottom: 1px solid #e9dfcc;
        background:
            radial-gradient(ellipse at top, #fffdf8 0%, transparent 65%),
            var(--paper);
    }

    .about-hero::before,
    .about-hero::after {
        content: '✦';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #d8c59d;
        font-size: 28px;
        opacity: .8;
    }

    .about-hero::before { left: 9%; }
    .about-hero::after { right: 9%; }

    .about-title {
        font-size: clamp(42px, 6vw, 72px);
        margin: 20px 0;
        letter-spacing: -1.5px;
    }

    .about-subtitle {
        color: var(--muted);
        max-width: 620px;
        margin: auto;
        line-height: 1.9;
        font-size: 15px;
    }

    /* STORY */
    .about-story {
        padding: 95px 0;
    }

    .about-story-title {
        font-size: clamp(32px, 4vw, 47px);
        line-height: 1.3;
        margin: 18px 0 25px;
    }

    .about-paragraph {
        color: var(--muted);
        line-height: 2;
        font-size: 14px;
    }

    .about-quote {
        border-left: 2px solid var(--gold);
        padding: 10px 0 10px 22px;
        margin-top: 30px;
        font-family: Georgia, serif;
        font-size: 19px;
        font-style: italic;
        line-height: 1.8;
        color: var(--gold-dark);
    }

    .about-art-panel {
        position: relative;
        background: linear-gradient(145deg, #f7f0e3, #e9dcc3);
        padding: 55px 35px;
        min-height: 390px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        border: 1px solid #d8c59d;
        outline: 1px solid #d8c59d;
        outline-offset: -10px;
        box-shadow: 12px 14px 0 rgba(184, 154, 90, .08);
        transition: box-shadow .4s ease;
    }

    .about-art-panel:hover {
        box-shadow: 16px 18px 0 rgba(184, 154, 90, .13);
    }

    .about-art-symbol {
        color: var(--gold-dark);
        font-family: Georgia, serif;
        font-size: 78px;
        margin-bottom: 12px;
        animation: floatArt 4s ease-in-out infinite;
    }

    .about-art-heading {
        font-size: 29px;
        margin-bottom: 0;
    }

    .about-art-text {
        color: var(--muted);
        line-height: 1.9;
        font-size: 14px;
        max-width: 300px;
        margin-bottom: 0;
    }

    .about-corner {
        position: absolute;
        color: var(--gold);
        font-size: 24px;
    }

    .about-corner.top-left { top: 17px; left: 20px; }
    .about-corner.top-right { top: 17px; right: 20px; }
    .about-corner.bottom-left { bottom: 17px; left: 20px; }
    .about-corner.bottom-right { bottom: 17px; right: 20px; }

    /* VISION & MISSION */
    .about-values {
        padding: 85px 0;
        background: #fff;
        border-top: 1px solid #eee7d9;
        border-bottom: 1px solid #eee7d9;
    }

    .about-section-title {
        font-size: clamp(32px, 4vw, 45px);
        margin-top: 15px;
    }

    .about-value-card {
        position: relative;
        height: 100%;
        padding: 38px 32px;
        background: var(--paper);
        border: 1px solid #e8dcc4;
        transition: transform .35s ease, box-shadow .35s ease,
                    border-color .35s ease;
    }

    .about-value-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        height: 3px;
        width: 0;
        background: var(--gold);
        transition: width .35s ease;
    }

    .about-value-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 35px rgba(63, 48, 22, .09);
        border-color: #d6c39a;
    }

    .about-value-card:hover::before {
        width: 100%;
    }

    .about-value-number {
        color: var(--gold);
        font-family: Georgia, serif;
        font-size: 32px;
        margin-bottom: 20px;
    }

    .about-value-title {
        font-size: 27px;
        margin-bottom: 15px;
    }

    .about-value-text {
        color: var(--muted);
        line-height: 1.9;
        font-size: 14px;
        margin-bottom: 0;
    }

    /* CONTACT */
    .about-contact {
        padding: 90px 0;
        background:
            radial-gradient(ellipse at center, #fffaf0 0%, transparent 75%),
            #f0e9db;
        border-bottom: 1px solid #dfd0b2;
    }

    .contact-card {
        display: flex;
        align-items: center;
        gap: 20px;
        height: 100%;
        padding: 28px 25px;
        background: rgba(255, 253, 248, .85);
        border: 1px solid #e0d1b3;
        text-decoration: none;
        color: var(--ink);
        transition: transform .3s ease, box-shadow .3s ease,
                    border-color .3s ease;
    }

    .contact-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 14px 28px rgba(63, 48, 22, .1);
        border-color: var(--gold);
        color: var(--ink);
    }

    .contact-icon {
        flex-shrink: 0;
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #d8c59d;
        border-radius: 50%;
        color: var(--gold-dark);
        font-size: 23px;
        transition: background .3s ease, color .3s ease;
    }

    .contact-card:hover .contact-icon {
        background: var(--gold);
        color: white;
    }

    .contact-label {
        color: var(--gold-dark);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 7px;
    }

    .contact-value {
        font-family: Georgia, serif;
        font-size: clamp(16px, 2vw, 20px);
        margin-bottom: 0;
        overflow-wrap: anywhere;
    }

    .contact-note {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.8;
    }

    /* CLOSING */
    .about-footer {
        position: relative;
        padding: 70px 20px;
        text-align: center;
        background: #faf8f3;
    }

    .about-footer .about-section-title {
        line-height: 1.35;
    }

    .about-footer-mark {
        color: var(--gold);
        font-size: 21px;
        margin-bottom: 18px;
        letter-spacing: 7px;
    }

    @media (max-width: 767px) {
        .about-hero {
            padding: 65px 20px;
        }

        .about-hero::before { left: 4%; }
        .about-hero::after { right: 4%; }

        .about-story,
        .about-values,
        .about-contact {
            padding: 60px 0;
        }

        .about-art-panel {
            min-height: 320px;
            padding: 45px 25px;
        }

        .about-value-card {
            padding: 30px 25px;
        }

        .contact-card {
            padding: 22px 18px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .about-page *,
        .about-page *::before,
        .about-page *::after {
            animation: none !important;
            transition: none !important;
            scroll-behavior: auto !important;
        }
    }
</style>

<div class="about-page">

    {{-- HERO --}}
    <section class="about-hero">
        <div class="container">
            <p class="about-label mb-0 animate-down">
                GET TO KNOW US
            </p>

            <h1 class="about-title animate-up delay-1">
                About Our Gallery
            </h1>

            <div class="about-divider"></div>

            <p class="about-subtitle animate-up delay-2">
                A space where creativity meets emotion, and every
                masterpiece has a story waiting to be discovered.
            </p>
        </div>
    </section>

    {{-- OUR STORY --}}
    <section class="about-story">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-7 animate-up">
                    <p class="about-label">OUR STORY</p>

                    <h2 class="about-story-title">
                        More Than Art,<br>
                        A World of Stories.
                    </h2>

                    <p class="about-paragraph">
                        Art Gallery merupakan galeri seni digital yang
                        menghadirkan beragam karya dari seniman berbagai
                        era. Kami menyediakan ruang bagi pengunjung untuk
                        mengenal dan mengapresiasi keindahan seni melalui
                        koleksi yang dapat dijelajahi secara digital.
                    </p>

                    <p class="about-paragraph">
                        Setiap karya memiliki karakter dan cerita tersendiri.
                        Melalui informasi mengenai judul, seniman, tahun
                        pembuatan, media, dan harga, pengunjung dapat
                        mengenal setiap karya dengan lebih dekat.
                    </p>

                    <div class="about-quote">
                        "Art speaks where words are unable to explain."
                    </div>
                </div>

                <div class="col-lg-5 animate-up delay-2">
                    <div class="about-art-panel">
                        <span class="about-corner top-left">✧</span>
                        <span class="about-corner top-right">✧</span>
                        <span class="about-corner bottom-left">✧</span>
                        <span class="about-corner bottom-right">✧</span>

                        <div class="about-art-symbol">A.</div>

                        <h3 class="about-art-heading">
                            The Art of Expression
                        </h3>

                        <div class="about-divider"></div>

                        <p class="about-art-text">
                            Every masterpiece captures a feeling,
                            preserves a moment, and inspires a new
                            perspective.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- VISION AND MISSION --}}
    <section class="about-values">
        <div class="container">

            <div class="text-center mb-5 animate-up">
                <p class="about-label">WHAT WE BELIEVE</p>

                <h2 class="about-section-title">
                    Our Vision &amp; Mission
                </h2>

                <div class="about-divider"></div>

                <p class="about-subtitle">
                    The values that shape our appreciation for art
                    and creativity.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-md-6 animate-up delay-1">
                    <div class="about-value-card">
                        <div class="about-value-number">01</div>

                        <h3 class="about-value-title">Our Vision</h3>

                        <p class="about-value-text">
                            Menjadi galeri seni digital yang memberikan
                            pengalaman menarik dalam mengenal, menemukan,
                            dan mengapresiasi berbagai karya seni dari
                            beragam seniman dan era.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 animate-up delay-2">
                    <div class="about-value-card">
                        <div class="about-value-number">02</div>

                        <h3 class="about-value-title">Our Mission</h3>

                        <p class="about-value-text">
                            Menyajikan koleksi karya seni beserta
                            informasi yang jelas, menyediakan akses
                            penjelajahan galeri secara digital, serta
                            mendorong ketertarikan masyarakat terhadap
                            nilai dan keindahan seni.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- CONTACT US --}}
    <section class="about-contact">
        <div class="container">

            <div class="text-center mb-5 animate-up">
                <p class="about-label">LET'S CONNECT</p>

                <h2 class="about-section-title">
                    Contact Us
                </h2>

                <div class="about-divider"></div>

                <p class="about-subtitle">
                    Have questions or want to know more about our gallery?
                    Feel free to get in touch with us.
                </p>
            </div>

            <div class="row justify-content-center g-4">

                <div class="col-md-6 col-lg-5 animate-up delay-1">
                    <a href="tel:021445396" class="contact-card">
                        <div class="contact-icon" aria-hidden="true">
                            &#9742;
                        </div>

                        <div>
                            <p class="contact-label">PHONE NUMBER</p>
                            <p class="contact-value">021-445-396</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-5 animate-up delay-2">
                    <a href="mailto:artgallery@gmail.com"
                       class="contact-card">
                        <div class="contact-icon" aria-hidden="true">
                            &#9993;
                        </div>

                        <div>
                            <p class="contact-label">EMAIL ADDRESS</p>
                            <p class="contact-value">
                                artgallery@gmail.com
                            </p>
                        </div>
                    </a>
                </div>

            </div>

            <p class="contact-note text-center mt-4 mb-0 animate-up delay-3">
                We look forward to hearing from you.
            </p>

        </div>
    </section>

    {{-- CLOSING --}}
    <section class="about-footer">
        <div class="about-footer-mark">✦ &nbsp; ✧ &nbsp; ✦</div>

        <p class="about-label mb-3">ART GALLERY</p>

        <h2 class="about-section-title mb-3">
            Discover Beauty in Every Detail.
        </h2>

        <p class="about-paragraph mb-0">
            Every artwork is an invitation to see the world differently.
        </p>
    </section>

</div>

@endsection
