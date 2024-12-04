<?php
session_start();
include 'db.php';

// Formdan gelen veriyi al
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Şifreyi hashle
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Veritabanına kaydet
    $sql = "INSERT INTO kullanici (kullanici_ad, kullanici_pass) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

    try {
        if ($stmt->execute()) {
            echo "Kullanıcı başarıyla kaydedildi!";
            header("Location: giris.php");
        } else {
            echo "Kayıt sırasında bir hata oluştu.";
        }
    } catch (PDOException $e) {
        echo "Kayıt hatası: " . $e->getMessage();
    }
}
?>
