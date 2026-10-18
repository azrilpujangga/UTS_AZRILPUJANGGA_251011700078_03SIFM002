<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artwork;

class ArtworkSeeder extends Seeder
{
    public function run(): void
    {
        $artworks = [
            [
                'title' => 'Starry Night',
                'artist' => 'Vincent van Gogh',
                'year' => 1889,
                'price' => 1500000000,
                'image' => 'starry-night.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'Mona Lisa',
                'artist' => 'Leonardo da Vinci',
                'year' => 1503,
                'price' => 2500000000,
                'image' => 'mona-lisa.jpg',
                'medium' => 'Oil on poplar panel',
            ],
            [
                'title' => 'The Great Wave',
                'artist' => 'Katsushika Hokusai',
                'year' => 1831,
                'price' => 800000000,
                'image' => 'great-wave.jpg',
                'medium' => 'Woodblock print',
            ],
            [
                'title' => 'The Persistence of Memory',
                'artist' => 'Salvador Dalí',
                'year' => 1931,
                'price' => 1200000000,
                'image' => 'persistence-memory.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'Girl with a Pearl Earring',
                'artist' => 'Johannes Vermeer',
                'year' => 1665,
                'price' => 950000000,
                'image' => 'pearl-earring.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'The Scream',
                'artist' => 'Edvard Munch',
                'year' => 1893,
                'price' => 1100000000,
                'image' => 'the-scream.jpg',
                'medium' => 'Oil, tempera, and pastel',
            ],
            [
                'title' => 'The Kiss',
                'artist' => 'Gustav Klimt',
                'year' => 1908,
                'price' => 1300000000,
                'image' => 'the-kiss.jpg',
                'medium' => 'Oil and gold leaf on canvas',
            ],
            [
                'title' => 'Water Lilies',
                'artist' => 'Claude Monet',
                'year' => 1916,
                'price' => 900000000,
                'image' => 'water-lilies.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'American Gothic',
                'artist' => 'Grant Wood',
                'year' => 1930,
                'price' => 750000000,
                'image' => 'american-gothic.jpg',
                'medium' => 'Oil on beaverboard',
            ],
            [
                'title' => 'The Birth of Venus',
                'artist' => 'Sandro Botticelli',
                'year' => 1485,
                'price' => 1400000000,
                'image' => 'birth-of-venus.jpg',
                'medium' => 'Tempera on canvas',
            ],

            // 20 DATA TAMBAHAN

            [
                'title' => 'The Night Watch',
                'artist' => 'Rembrandt',
                'year' => 1642,
                'price' => 1250000000,
                'image' => 'night-watch.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'The Son of Man',
                'artist' => 'René Magritte',
                'year' => 1964,
                'price' => 900000000,
                'image' => 'son-of-man.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'Composition VIII',
                'artist' => 'Wassily Kandinsky',
                'year' => 1923,
                'price' => 750000000,
                'image' => 'composition-viii.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => "Campbell's Soup Cans",
                'artist' => 'Andy Warhol',
                'year' => 1962,
                'price' => 800000000,
                'image' => 'campbells-soup-cans.jpg',
                'medium' => 'Synthetic polymer paint',
            ],
            [
                'title' => 'The Sleeping Gypsy',
                'artist' => 'Henri Rousseau',
                'year' => 1897,
                'price' => 720000000,
                'image' => 'sleeping-gypsy.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'The Arnolfini Portrait',
                'artist' => 'Jan van Eyck',
                'year' => 1434,
                'price' => 1000000000,
                'image' => 'arnolfini-portrait.jpg',
                'medium' => 'Oil on oak panel',
            ],
            [
                'title' => 'Liberty Leading the People',
                'artist' => 'Eugène Delacroix',
                'year' => 1830,
                'price' => 980000000,
                'image' => 'liberty-leading-people.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'A Sunday Afternoon on the Island of La Grande Jatte',
                'artist' => 'Georges Seurat',
                'year' => 1886,
                'price' => 1150000000,
                'image' => 'sunday-afternoon.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'The Garden of Earthly Delights',
                'artist' => 'Hieronymus Bosch',
                'year' => 1505,
                'price' => 1350000000,
                'image' => 'garden-earthly-delights.jpg',
                'medium' => 'Oil on oak panels',
            ],
            [
                'title' => 'No. 5, 1948',
                'artist' => 'Jackson Pollock',
                'year' => 1948,
                'price' => 1600000000,
                'image' => 'number-five-1948.jpg',
                'medium' => 'Oil on fiberboard',
            ],
            [
                'title' => 'The Sleeping Venus',
                'artist' => 'Giorgione',
                'year' => 1510,
                'price' => 850000000,
                'image' => 'sleeping-venus.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'Impression, Sunrise',
                'artist' => 'Claude Monet',
                'year' => 1872,
                'price' => 780000000,
                'image' => 'impression-sunrise.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'The Hay Wain',
                'artist' => 'John Constable',
                'year' => 1821,
                'price' => 820000000,
                'image' => 'the-hay-wain.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'The Creation of Adam',
                'artist' => 'Michelangelo',
                'year' => 1512,
                'price' => 1450000000,
                'image' => 'creation-of-adam.jpg',
                'medium' => 'Fresco',
            ],
            [
                'title' => 'The School of Athens',
                'artist' => 'Raphael',
                'year' => 1511,
                'price' => 1350000000,
                'image' => 'school-of-athens.jpg',
                'medium' => 'Fresco',
            ],
            [
                'title' => 'The Fighting Temeraire',
                'artist' => 'J. M. W. Turner',
                'year' => 1839,
                'price' => 950000000,
                'image' => 'fighting-temeraire.jpg',
                'medium' => 'Oil on canvas',
            ],
            [
                'title' => 'The Sleeping Gypsy at Dusk',
                'artist' => 'Digital Artist',
                'year' => 2025,
                'price' => 350000000,
                'image' => 'sleeping-gypsy-dusk.jpg',
                'medium' => 'Digital art',
            ],
            [
                'title' => 'Golden Abstract',
                'artist' => 'Digital Artist',
                'year' => 2025,
                'price' => 400000000,
                'image' => 'golden-abstract.jpg',
                'medium' => 'Digital art',
            ],
            [
                'title' => 'Dreamscape',
                'artist' => 'Digital Artist',
                'year' => 2025,
                'price' => 300000000,
                'image' => 'dreamscape.jpg',
                'medium' => 'Digital art',
            ],
            [
                'title' => 'Eternal Bloom',
                'artist' => 'Digital Artist',
                'year' => 2025,
                'price' => 375000000,
                'image' => 'eternal-bloom.jpg',
                'medium' => 'Digital art',
            ],
        ];

        foreach ($artworks as $artwork) {
    Artwork::firstOrCreate(
        ['title' => $artwork['title']],
        $artwork
    );
}
    }
}
