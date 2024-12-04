<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcıyı veritabanında kontrol et
    $sql = "SELECT kullanici_id, kullanici_pass FROM kullanici WHERE kullanici_ad = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['kullanici_pass'])) {
        // Başarılı giriş, kullanıcıyı oturumda sakla
        $_SESSION['kullanici_id'] = $user['kullanici_id'];
        // Dosya yükleme sayfasına yönlendir
        header("Location: dosya_yukle.php");
        exit();
    } else {
        echo "Geçersiz kullanıcı adı veya şifre.";
    }
}
?>
