<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="girisSayfasi.css"> 
</head>
<body>
    <div class="form-container">   

        <h2>Giriş Yap</h2>
        <form action="girisislemi.php" method="POST">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" name="username" required>

            <label for="password">Şifre:</label>
            <input type="password" name="password" required>

            <button type="submit">Giriş Yap</button>   

        </form>
        <p>Hesabınız yok mu? <a href="kayit.html">Kayıt olun</a></p>
    </div>
</body>
</html>
