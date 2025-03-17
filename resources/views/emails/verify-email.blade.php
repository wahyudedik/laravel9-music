<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Email</title>
</head>
<body>
    <h2>Halo, {{ $user->name }}!</h2>
    <p>Terima kasih telah mendaftar. Silakan klik tombol di bawah untuk memverifikasi email Anda:</p>
    <p>
        <a href="{{ $verificationUrl }}"
           style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
           Verifikasi Email
        </a>
    </p>
    <p>Jika Anda tidak mendaftar di aplikasi kami, abaikan email ini.</p>
</body>
</html>
