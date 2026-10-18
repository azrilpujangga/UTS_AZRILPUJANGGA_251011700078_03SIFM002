@extends('layouts.app')

@section('title', 'Home | Art Gallery')

@section('content')

<style>
    .gallery-entrance {
        min-height: 85vh;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e8d8bd;
        perspective: 1600px;
    }

    /* Pemandangan galeri di balik gerbang */
    .gallery-interior {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 30px;
        background:
            linear-gradient(#f7ead5a8, #f7ead580),
            url('{{ asset("assets/images/gallery-interior.jpg") }}')
            center / cover,
            #e8d8bd;
    }

    .gallery-interior h1 {
        font-size: clamp(36px, 5vw, 65px);
        color: #352518;
        letter-spacing: 3px;
    }

    .gallery-interior p {
        color: #654a32;
        font-size: 18px;
        margin: 15px 0 28px;
    }

    .enter-gallery {
        padding: 15px 30px;
        color: #fff8eb;
        background: #382619;
        border: 1px solid #b79a70;
        text-decoration: none;
        letter-spacing: 3px;
        font-size: 12px;
        opacity: 0;
        transform: translateY(15px);
        pointer-events: none;
        transition: .6s ease;
    }

    .enter-gallery:hover {
        color: white;
        background: #89653d;
    }

    .gallery-entrance.open .enter-gallery {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
        transition-delay: .8s;
    }

    /* Dua sisi gerbang */
    .gate {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 50%;
        z-index: 2;
        cursor: pointer;
        transform-style: preserve-3d;
        transition: transform 1.8s cubic-bezier(.65, 0, .35, 1);
        background:
            repeating-linear-gradient(
                90deg,
                #00000012 0,
                #ffffff08 18px,
                #00000020 36px
            ),
            linear-gradient(90deg, #4a2d1b, #805737 45%, #382116);
        border: 12px solid #382316;
        box-shadow: inset 0 0 0 4px #b18a58,
                    inset 0 0 30px #160b06;
    }

    .gate::before {
        content: "";
        position: absolute;
        inset: 25px;
        border: 3px double #c1a06b;
        box-shadow: inset 0 0 18px #160b0640;
    }

    .gate::after {
        content: "";
        position: absolute;
        inset: 45px 38px;
        border: 2px solid #a78250;
        box-shadow: inset 0 0 15px #160b0640;
    }

    .gate-left {
        left: 0;
        transform-origin: left center;
        border-right: 5px solid #c4a06a;
    }

    .gate-right {
        right: 0;
        transform-origin: right center;
        border-left: 5px solid #c4a06a;
    }

    .gate-handle {
        position: absolute;
        top: 50%;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, #f5d99c, #9b7038);
        box-shadow: 0 0 12px #e7c78c70;
        z-index: 3;
    }

    .gate-left .gate-handle {
        right: 20px;
    }

    .gate-right .gate-handle {
        left: 20px;
    }

    .gate-label {
        position: absolute;
        z-index: 4;
        bottom: 35px;
        left: 0;
        right: 0;
        color: #e9d2a8;
        text-align: center;
        font-size: 12px;
        letter-spacing: 4px;
        pointer-events: none;
    }

    /* Gerbang membuka ke belakang */
    .gallery-entrance.open .gate-left {
        transform: rotateY(-115deg);
    }

    .gallery-entrance.open .gate-right {
        transform: rotateY(115deg);
    }

    .open-hint {
        position: absolute;
        z-index: 5;
        bottom: 12px;
        color: #fff4df;
        font-size: 10px;
        letter-spacing: 3px;
        text-shadow: 0 1px 5px #000;
        pointer-events: none;
    }

    .gallery-entrance.open .open-hint {
        opacity: 0;
        transition: opacity .3s;
    }

    @media (max-width: 576px) {
        .gallery-entrance {
            min-height: 78vh;
        }

        .gate {
            border-width: 6px;
        }

        .gate::before {
            inset: 15px;
        }

        .gate::after {
            inset: 30px 20px;
        }

        .gallery-interior p {
            font-size: 15px;
        }
    }
</style>

<section class="gallery-entrance" id="galleryEntrance">

    <div class="gallery-interior">
        <p class="text-uppercase mb-2"
           style="letter-spacing: 5px; font-size: 12px;">
            Welcome to
        </p>

        <h1>ART GALLERY</h1>

        <p>Where every masterpiece tells a story.</p>

        <a href="{{ route('artworks.index') }}"
           class="enter-gallery">
            ENTER THE GALLERY &rarr;
        </a>
    </div>

    <div class="gate gate-left" role="button" tabindex="0"
         aria-label="Buka gerbang kiri">
        <span class="gate-handle"></span>
    </div>

    <div class="gate gate-right" role="button" tabindex="0"
         aria-label="Buka gerbang kanan">
        <span class="gate-handle"></span>
    </div>

    <div class="gate-label">A R T &nbsp; G A L L E R Y</div>
    <div class="open-hint">KLIK GERBANG UNTUK MEMBUKA</div>

</section>

<script>
    const entrance = document.getElementById('galleryEntrance');

    function toggleGate() {
        entrance.classList.toggle('open');
    }

    entrance.querySelectorAll('.gate').forEach(function(gate) {
        gate.addEventListener('click', toggleGate);

        gate.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                toggleGate();
            }
        });
    });
</script>

@endsection
