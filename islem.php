<?php
session_start();
include 'db.php'; // Veritabanı bağlantısını sağlayan dosya

// Dosya yükleme işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['fileToUpload']['name'];
        $tempPath = $_FILES['fileToUpload']['tmp_name'];
        $uploadPath = 'uploads/' . basename($fileName); // Yükleme dizini

        // Kullanıcı ID'sini session'dan al
        $kullanici_id = $_SESSION['kullanici_id']; // Kullanıcının session'daki ID'si

        // Önce dosyanın veritabanında var olup olmadığını kontrol et
        $sqlCheck = "SELECT COUNT(*) FROM dosya WHERE kullanici_id = :kullanici_id AND dosya_ad = :dosya_ad";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':kullanici_id', $kullanici_id);
        $stmtCheck->bindParam(':dosya_ad', $fileName);
        $stmtCheck->execute();

        if ($stmtCheck->fetchColumn() > 0) {
            echo "Bu dosyayı daha önce yüklemiştiniz.";
        } else {
            // Yükleme dizini yoksa oluştur
            if (!is_dir('uploads')) {
                mkdir('uploads', 0755, true);
            }

            // Dosyayı yükle
            if (move_uploaded_file($tempPath, $uploadPath)) {
                // Dosya bilgilerini veritabanına kaydet
                $sql = "INSERT INTO dosya (kullanici_id, dosya_ad, created_at) VALUES (:kullanici_id, :dosya_ad, NOW())";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':kullanici_id', $kullanici_id);
                $stmt->bindParam(':dosya_ad', $fileName);

                if ($stmt->execute()) {
                    echo "Dosya başarıyla yüklendi ve veritabanına kaydedildi: $fileName";
                    echo "<br>";
                    echo "<a href='listele.php'>
                    <button>Listele</button>
                    </a>";
                } else {
                    echo "Veritabanına kayıt sırasında bir hata oluştu.";
                }
            } else {
                echo "Dosya yüklenirken bir hata oluştu.";
            }
        }
    } else {
        echo "Lütfen bir dosya seçin.";
    }
}
?>


