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
