<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosya Yükle</title>
    <link rel="stylesheet" href="dosyaYukle.css"> 
</head>
<body>
    <h2>Dosya Yükle</h2>
    <form action="islem.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Yüklemek istediğiniz dosyayı seçin:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" required>
        <input type="submit" value="Dosyayı Yükle">
    </form>
</body>
</html>
