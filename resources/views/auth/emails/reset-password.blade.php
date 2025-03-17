<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist Music - Reset Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            color: #fd2929;
            font-size: 24px;
            font-weight: bold;
        }

        .button {
            display: inline-block;
            background-color: #fd2929;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
        }

        .button:hover {
            background-color: #c0392b;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>

<body> 
    <div class="email-container">
        <div class="header">
            <div class="brand-logo text-center mb-4">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('img/icon1.png') }}" alt="Logo" width="150" height="50">
                </a>
            </div>
        </div>
        <h2>Halo,</h2>
        <p>Kami menerima permintaan untuk mereset password akun Anda. Silakan klik tombol di bawah ini untuk melanjutkan
            proses reset password:</p>

        <div style="text-align: center;">
            <a href="{{ url('password/reset/' . $token . '?email=' . $email) }}" class="button">Reset Password</a>
        </div>

        <p>Jika tombol di atas tidak berfungsi, Anda dapat menyalin dan menempelkan URL berikut ke browser Anda:</p>
        <p style="word-break: break-all;">{{ url('password/reset/' . $token . '?email=' . $email) }}</p>

        <p>Jika Anda tidak meminta reset password, abaikan email ini dan password Anda akan tetap aman.</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Playlist Music. All rights reserved.</p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>

</html>
