<?php
session_start();
include 'db.php'; // Veritabanı bağlantısını sağlayan dosya

// Kullanıcının yüklediği dosyaları al
$kullanici_id = $_SESSION['kullanici_id'];
$sql = "SELECT * FROM dosya WHERE kullanici_id = :kullanici_id ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':kullanici_id', $kullanici_id);
$stmt->execute();
$dosyalar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yüklenen Dosyalar</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .slider {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scrollbar-width: none; /* Firefox için */
        }

        .slide {
            flex: none;
            width: 300px; /* Her bir slide genişliği */
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            scroll-snap-align: start;
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
        }

        .slide img {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .slide h4 {
            margin: 10px 0;
            font-size: 1.2rem;
            color: #333;
        }

        .slide p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>

<h2>Yüklediğiniz Dosyalar</h2>

<div class="slider">
    <?php if ($dosyalar): ?>
        <?php foreach ($dosyalar as $dosya): ?>
            <div class="slide">
                <img src="uploads/<?php echo htmlspecialchars($dosya['dosya_ad']); ?>" alt="<?php echo htmlspecialchars($dosya['dosya_ad']); ?>">
                <h4><?php echo htmlspecialchars($dosya['dosya_ad']); ?></h4>
                <p>Kullanıcı ID: <?php echo htmlspecialchars($dosya['kullanici_id']); ?></p>
                <p>Oluşturma Tarihi: <?php echo htmlspecialchars($dosya['created_at']); ?></p>
                <p>Dosya Yolu: <?php echo htmlspecialchars("uploads/" . $dosya['dosya_ad']); ?></p>
                <p>Dosya Boyutu: <?php echo htmlspecialchars($dosya['boyut']); ?> KB</p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Henüz yüklediğiniz dosya yok.</p>
    <?php endif; ?>
</div>

</body>
</html>
