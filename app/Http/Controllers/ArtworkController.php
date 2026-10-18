<?php

namespace App\Http\Controllers;

use App\Models\Artwork;

class ArtworkController extends Controller
{
    public function index()
{
    $artworks = Artwork::paginate(6);

    return view('artworks.index', compact('artworks'));
}

public function show($id)
{
    $artwork = Artwork::findOrFail($id);

    $histories = [
        'Starry Night' => 'Painted in June 1889 while Vincent van Gogh was staying at the Saint-Paul-de-Mausole asylum in France. The painting depicts a dramatic night sky filled with swirling stars above a quiet village. It is widely regarded as one of the most important works of Post-Impressionism.',

        'Mona Lisa' => 'Created by Leonardo da Vinci during the Italian Renaissance, the Mona Lisa is famous for its mysterious smile and subtle use of light and shadow. The painting is believed to portray Lisa Gherardini, a woman from Florence, Italy.',

        'The Great Wave' => 'Created by Japanese artist Katsushika Hokusai around 1831, The Great Wave off Kanagawa is a famous woodblock print from the series Thirty-six Views of Mount Fuji. It portrays enormous waves threatening boats, with Mount Fuji visible in the distance.',

        'The Persistence of Memory' => 'Painted by Salvador Dalí in 1931, this surrealist masterpiece features melting clocks in a strange, dreamlike landscape. The work explores ideas about time, memory, and the unstable nature of human perception.',

        'Girl with a Pearl Earring' => 'Painted by Johannes Vermeer around 1665, this artwork is often described as a tronie, a study of an imagined character rather than a traditional portrait. Its striking use of light, dark background, and a luminous pearl earring has made it one of the most recognizable paintings in Dutch art.',

        'The Scream' => 'Created by Norwegian artist Edvard Munch in 1893, The Scream expresses intense anxiety and emotional distress. The distorted landscape and dramatic colors reflect the psychological tension that became a defining feature of modern art.',

        'The Kiss' => 'Created by Gustav Klimt between 1907 and 1908, The Kiss belongs to his celebrated Golden Phase. The painting combines intimate human figures with decorative patterns and gold leaf, reflecting the influence of Byzantine art and the Vienna Secession movement.',

        'Water Lilies' => 'Water Lilies refers to a large series of paintings by French Impressionist Claude Monet. Created during the later years of his life at his garden in Giverny, these works explore reflections, changing light, and the relationship between water, plants, and the surrounding atmosphere.',

        'American Gothic' => 'Painted by Grant Wood in 1930, American Gothic depicts a farmer holding a pitchfork beside a woman in front of a distinctive house. The painting became an iconic image of American culture during the Great Depression.',

        'The Birth of Venus' => 'Painted by Sandro Botticelli in the mid-1480s, this Renaissance masterpiece depicts Venus emerging from the sea on a shell. Inspired by classical mythology, the work reflects the renewed interest in ancient Greek and Roman culture during the Italian Renaissance.',
    ];

    $history = $histories[$artwork->title]
        ?? $artwork->title . ' is a work by ' . $artwork->artist
        . ', created in ' . $artwork->year
        . '. This artwork reflects the artistic ideas, techniques, and visual traditions associated with its creator and period. Its composition and medium offer viewers an opportunity to explore the artist’s approach to color, form, and meaning.';

    return view('artworks.show', compact('artwork', 'history'));
}
}
