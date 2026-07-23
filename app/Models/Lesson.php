<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'content_type',
        'body_content',
        'image_url',
        'audio_url',
        'sorting_order'
    ];

    protected $appends = ['video_url'];

    public function getVideoUrlAttribute()
    {
        $mapping = [
            // English Rhymes
            'Twinkle Twinkle Little Star' => 'https://youtube.com/shorts/UeRUKo3xWRQ?si=3OWjhNcVhYAmuiIi',
            'Humpty Dumpty Sat on a Wall' => 'https://youtube.com/shorts/0lKcj9cAWLI?si=QGiodH5Ca3HBwm5u',
            'Ba Ba Black Sheep' => 'https://youtube.com/shorts/n8FdWEfczJw?si=QXXfn0GRuk8au-PD',

            // Hindi Rhymes
            'मछली जल की रानी है' => 'https://youtube.com/shorts/9SoTwfENHAw?si=c0K2bx0nI1nu98vZ',
            'चंदा मामा दूर के' => 'https://youtube.com/shorts/7CVR4cQkRKs?si=10m-Xv_H-1O-bzTW',
            'तीतर और बटेर' => 'https://youtube.com/shorts/ogzSxKjvj6w?si=MpI9JgLpStE3I3qP',

            // Devotional Mantras
            'Gayatri Mantra' => 'https://youtube.com/shorts/LJSmHX7m8r0?si=bfiP3zbPG969l-ze',
            'Mahamrityunjaya Mantra' => 'https://youtube.com/shorts/XMb4KsoCRrY?si=1lxfJhKoLlBvE28o',
            'Ganesh Mantra' => 'https://youtube.com/shorts/X01px_YPIYA?si=U4H39pZUOpM4DGJ2',
            'Hare Krishna Maha Mantra' => 'https://youtube.com/shorts/6KbIXzb1h4I?si=AHxt7WV4wPnxlvGH',
            'Saraswati Mantra' => 'https://youtube.com/shorts/AFGPatLpZFw?si=ZgtChpGoKyuJvlxW',
            'Guru Mantra' => 'https://youtube.com/shorts/ycvqpPFyQSU?si=HcIM6ZwM3zF2Aq5t',

            // Devotional Aartis
            'Ganesh Aarti' => 'https://youtube.com/shorts/ZIWSLspXV5Y?si=OxoApbrU57Z80YvT',
            'Om Jai Jagdish Hare' => 'https://youtube.com/shorts/tD_F52vcxpE?si=99qwQztvOSJlVdNq',
            'Hanuman Aarti' => 'https://youtube.com/shorts/vzPZkP-yVgE?si=JieF-oWZH9t-pR8q',
            'Shiva Aarti' => 'https://youtube.com/shorts/Xg8ww3mt-zs?si=o46tGUJ5FckP9NIu',
            'Laxmi Aarti' => 'https://youtube.com/shorts/KZcbwD8CB8M?si=1BoOsE3sf0Kk1_hf',
            'Ambe Maa Aarti' => 'https://youtube.com/shorts/x-j5JcByNk0?si=oBui33a1TJnwpjhG',

            // Devotional Stories
            'Baby Krishna Story' => 'https://www.youtube.com/embed/ZfC6o5N0mEE',
            "Lord Ganesha's Wisdom" => 'https://www.youtube.com/embed/7V2C0fP6c6I',
            'Little Hanuman and the Sun' => 'https://www.youtube.com/embed/p1oE5B26X_o',
            "Prahlad's Faith and Narasimha" => 'https://www.youtube.com/embed/sYk4n71P07E',
            'Dhruva Tara (The Little Prince)' => 'https://www.youtube.com/embed/14dsk5qQ9mQ',
            'Rama and the Little Squirrel' => 'https://www.youtube.com/embed/304W5qR9fBE',

            // Cultural Moral Stories
            'The Festival of Diwali' => 'https://www.youtube.com/embed/_0m20YfX6i8',
            'The Thirsty Crow' => 'https://www.youtube.com/embed/jZ_yP2H97vA',
            'The Honest Woodcutter' => 'https://www.youtube.com/embed/j0L_T3V-y0g',
        ];

        $url = $mapping[$this->title] ?? null;
        if (!$url) {
            return null;
        }

        // Convert standard YouTube watch/shorts link to embed format
        if (strpos($url, 'embed') === false) {
            $videoId = null;
            if (strpos($url, '/shorts/') !== false) {
                $parts = explode('/shorts/', $url);
                if (isset($parts[1])) {
                    $idParts = explode('?', $parts[1]);
                    $videoId = $idParts[0];
                }
            } elseif (strpos($url, 'v=') !== false) {
                $parts = explode('v=', $url);
                if (isset($parts[1])) {
                    $idParts = explode('&', $parts[1]);
                    $videoId = $idParts[0];
                }
            } elseif (strpos($url, 'youtu.be/') !== false) {
                $parts = explode('youtu.be/', $url);
                if (isset($parts[1])) {
                    $idParts = explode('?', $parts[1]);
                    $videoId = $idParts[0];
                }
            }

            if ($videoId) {
                return 'https://www.youtube.com/embed/' . trim($videoId);
            }
        }

        return $url;
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'lesson_id');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'lesson_id');
    }
}
