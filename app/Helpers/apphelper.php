<?php

if (!function_exists('youtube_embed')) {
    function convert_youtube($url)
    {
        // Match YouTube URL formats
        $pattern = '%(?:youtube\.com/(?:[^/]+/.+/|(?:v|embed)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';

        if (preg_match($pattern, $url, $matches)) {
            $videoId = $matches[1];
            return "https://www.youtube.com/embed/{$videoId}";
        }

        return null; // or return original $url
    }
}
