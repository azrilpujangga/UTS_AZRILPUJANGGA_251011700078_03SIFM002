import json
import time
import urllib.parse
import urllib.request
from pathlib import Path

# Run this script from the Laravel project root. It downloads artwork images
# into public/assets/images using the exact filenames in ArtworkSeeder.php.
ARTWORKS = [
    ("night-watch.jpg", "The Night Watch Rembrandt painting"),
    ("son-of-man.jpg", "The Son of Man Rene Magritte painting"),
    ("composition-viii.jpg", "Composition VIII Wassily Kandinsky 1923 painting"),
    ("campbells-soup-cans.jpg", "Campbell's Soup Cans Andy Warhol artwork"),
    ("sleeping-gypsy.jpg", "The Sleeping Gypsy Henri Rousseau painting"),
    ("arnolfini-portrait.jpg", "Arnolfini Portrait Jan van Eyck painting"),
    ("liberty-leading-people.jpg", "Liberty Leading the People Eugene Delacroix painting"),
    ("sunday-afternoon.jpg", "A Sunday Afternoon on the Island of La Grande Jatte Seurat painting"),
    ("garden-earthly-delights.jpg", "Garden of Earthly Delights Hieronymus Bosch painting"),
    ("number-five-1948.jpg", "No 5 1948 Jackson Pollock painting"),
    ("sleeping-venus.jpg", "Sleeping Venus Giorgione painting"),
    ("impression-sunrise.jpg", "Impression Sunrise Claude Monet painting"),
    ("the-hay-wain.jpg", "The Hay Wain John Constable painting"),
    ("creation-of-adam.jpg", "The Creation of Adam Michelangelo Sistine Chapel"),
    ("school-of-athens.jpg", "The School of Athens Raphael fresco"),
    ("fighting-temeraire.jpg", "The Fighting Temeraire J M W Turner painting"),
    ("sleeping-gypsy-dusk.jpg", "surreal dreamy sleeping gypsy at dusk digital art"),
    ("golden-abstract.jpg", "gold abstract contemporary digital art"),
    ("dreamscape.jpg", "dreamscape surreal digital art landscape"),
    ("eternal-bloom.jpg", "eternal bloom floral digital art"),
]


def request_json(url):
    req = urllib.request.Request(url, headers={"User-Agent": "ArtGalleryStudentProject/1.0 (image asset downloader)"})
    with urllib.request.urlopen(req, timeout=30) as response:
        return json.loads(response.read().decode("utf-8"))


def find_image(query):
    # Search Wikimedia Commons for a usable thumbnail.
    params = {
        "action": "query", "format": "json", "generator": "search",
        "gsrsearch": "filetype:bitmap " + query, "gsrnamespace": 6,
        "gsrlimit": 8, "prop": "imageinfo", "iiprop": "url|mime",
        "iiurlwidth": 1000,
    }
    url = "https://commons.wikimedia.org/w/api.php?" + urllib.parse.urlencode(params)
    data = request_json(url)
    pages = list(data.get("query", {}).get("pages", {}).values())
    for page in pages:
        infos = page.get("imageinfo", [])
        if not infos:
            continue
        info = infos[0]
        mime = info.get("mime", "")
        candidate = info.get("thumburl") or info.get("url")
        if candidate and mime.startswith("image/"):
            return candidate, page.get("title", "")
    return None, None


def main():
    out_dir = Path("public/assets/images")
    out_dir.mkdir(parents=True, exist_ok=True)
    failed = []
    for filename, query in ARTWORKS:
        target = out_dir / filename
        if target.exists() and target.stat().st_size > 5000:
            print(f"SKIP  {filename} (sudah ada)")
            continue
        try:
            url, title = find_image(query)
            if not url:
                raise RuntimeError("tidak menemukan gambar di Wikimedia Commons")
            req = urllib.request.Request(url, headers={"User-Agent": "ArtGalleryStudentProject/1.0"})
            with urllib.request.urlopen(req, timeout=45) as response:
                content = response.read()
                content_type = response.headers.get("Content-Type", "")
            if not content_type.startswith("image/") or len(content) < 5000:
                raise RuntimeError("hasil unduhan bukan file gambar yang valid")
            # Wikimedia thumbnail URLs generally use JPG/PNG/WEBP. Keep bytes and
            # convert to JPG when needed using Pillow, if installed.
            if not url.lower().split("?")[0].endswith((".jpg", ".jpeg")):
                try:
                    from PIL import Image
                    import io
                    image = Image.open(io.BytesIO(content)).convert("RGB")
                    image.save(target, "JPEG", quality=90, optimize=True)
                except ImportError:
                    # Save only if the downloaded content is already JPEG.
                    if content_type == "image/jpeg":
                        target.write_bytes(content)
                    else:
                        raise RuntimeError("gambar bukan JPG dan Pillow belum terpasang; jalankan: python -m pip install pillow")
            else:
                target.write_bytes(content)
            print(f"OK    {filename} <- {title}")
        except Exception as exc:
            failed.append((filename, str(exc)))
            print(f"GAGAL {filename}: {exc}")
        time.sleep(0.4)
    print("\nSelesai. Folder tujuan: public/assets/images")
    if failed:
        print("\nFile yang perlu dicoba ulang:")
        for name, reason in failed:
            print(f"- {name}: {reason}")
        print("\nPastikan koneksi internet aktif. Untuk konversi gambar, install Pillow: python -m pip install pillow")
    else:
        print("Semua 20 nama file sudah tersedia atau sebelumnya sudah ada.")

if __name__ == "__main__":
    main()
