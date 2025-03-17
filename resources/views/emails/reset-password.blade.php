<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Cool Poll - Reset Password</title>
</head>
<body>
    <h2>Halo,</h2>
    <p>Klik link di bawah ini untuk mereset password Anda:</p>
    <a href="{{ url('password/reset/' . $token.'?email='.$email) }}">Reset Password</a>
    <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
</body>
</html>
