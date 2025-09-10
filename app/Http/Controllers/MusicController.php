<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MusicController extends Controller
{
    private $musicDB = [
        'happy' => [
            ["song" => "Happy", "artist" => "Pharrell Williams"],
            ["song" => "Uptown Funk", "artist" => "Mark Ronson ft. Bruno Mars"],
            ["song" => "Good as Hell", "artist" => "Lizzo"]
        ],
        'sad' => [
            ["song" => "Someone Like You", "artist" => "Adele"],
            ["song" => "Fix You", "artist" => "Coldplay"],
            ["song" => "All I Want", "artist" => "Kodaline"]
        ],
        'relaxed' => [
            ["song" => "Weightless", "artist" => "Marconi Union"],
            ["song" => "Sunset Lover", "artist" => "Petit Biscuit"]
        ],
        'energetic' => [
            ["song" => "Stronger", "artist" => "Kanye West"],
            ["song" => "Eye of the Tiger", "artist" => "Survivor"]
        ],
        'romantic' => [
            ["song" => "Thinking Out Loud", "artist" => "Ed Sheeran"],
            ["song" => "All of Me", "artist" => "John Legend"]
        ],
    ];

    // Show all moods
    public function moods()
    {
        return response()->json([
            "available_moods" => array_keys($this->musicDB)
        ]);
    }

    // Get music by mood
    public function music(Request $request)
    {
        $mood = strtolower($request->query('mood'));
        $limit = intval($request->query('limit', 1));

        if (!isset($this->musicDB[$mood])) {
            return response()->json([
                "error" => "Mood not found. Use /moods to see available moods."
            ], 400);
        }

        $songs = $this->musicDB[$mood];
        shuffle($songs);

        if ($limit > count($songs)) {
            $limit = count($songs);
        }

        if ($limit == 1) {
            return response()->json([
                "mood" => $mood,
                "song" => $songs[0]["song"],
                "artist" => $songs[0]["artist"]
            ]);
        } else {
            return response()->json(array_slice($songs, 0, $limit));
        }
    }
}
