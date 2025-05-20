<?php

if (!function_exists('convert_youtube')) {
    function convert_youtube($url)
    {
        $pattern = '~
        ^(?:https?://)?      # Protokol opsional
        (?:www\.)?           # Subdomain www opsional
        (?:                  # Domain YouTube
          youtube\.com       # youtube.com
          /watch\?v=         # Format watch?v=
          ([^&]+)           # Tangkap ID video (semua karakter kecuali &)
        | youtube\.com      # Atau domain YouTube dengan format lain
          /embed/
          ([^/?&]+)
        | youtu\.be/         # Atau youtu.be
          ([^/?&]+)
        )
        ~xi';

        if (preg_match($pattern, $url, $matches)) {
            // Gabungkan semua kelompok tangkapan (hanya satu yang akan berisi nilai)
            $videoId = $matches[1] ?: ($matches[2] ?: $matches[3]);

            if (strlen($videoId) === 11) {
                return 'https://www.youtube.com/embed/' . $videoId;
            }
        }

        return null;
    }
}


if (!function_exists('convert_youtubev2')) {
    function convert_youtubev2($url)
    {
        $pattern = '~
        ^(?:https?://)?          # Optional protocol
        (?:www\.)?               # Optional www
        (?:                     # Start group for YouTube domains
            youtube\.com/        # youtube.com/...
                (?:
                    watch\?v=    # watch?v=VIDEO_ID
                    |embed/      # embed/VIDEO_ID
                    |shorts/     # shorts/VIDEO_ID
                )
                ([^/?&]+)        # Capture the video ID
            |youtu\.be/         # or youtu.be/VIDEO_ID
                ([^/?&]+)        # Capture the video ID
        )
        ~xi';

        if (preg_match($pattern, $url, $matches)) {
            // Use the first matched ID that is not empty
            $videoId = $matches[1] ?? $matches[2] ?? null;

            if ($videoId && strlen($videoId) === 11) {
                return 'https://www.youtube.com/embed/' . $videoId;
            }
        }

        return null;
    }
}
