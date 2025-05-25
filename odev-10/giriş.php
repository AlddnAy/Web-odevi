<?php
// Kullanıcı adı ve şifre kontrolü için tanımlanan bilgiler
$valid_username = "g231210077@sakarya.edu.tr";
$valid_password = "g231210077";
$loggedIn = false; // Kullanıcı giriş durumu başlangıçta false olarak ayarlanır
$error_message = ""; // Hata mesajı için değişken

// Eğer sayfa POST isteğiyle yüklendiyse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = trim($_POST["username"] ?? ""); // Boşlukları temizle
    $input_password = trim($_POST["password"] ?? ""); // Boşlukları temizle

    // Kullanıcı adı ve şifre alanlarının boş olup olmadığını kontrol et
    if (empty($input_username) || empty($input_password)) {
        $error_message = "Kullanıcı adı ve şifre boş bırakılamaz!";
    } 
    // Kullanıcı adının e-posta formatında olup olmadığını kontrol et
    elseif (!filter_var($input_username, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Kullanıcı adı geçerli bir e-posta adresi olmalıdır!";
    }
    // Kullanıcı adı ve şifre kontrolü
    elseif ($input_username === $valid_username && $input_password === $valid_password) {
        $loggedIn = true; // Kullanıcı giriş yaptı
        // Başarılı giriş durumunda 3 saniye sonra anasayfaya yönlendirme yapılır
        echo "<p style='color: green;'>Giriş başarılı! Yönlendiriliyorsunuz...</p>";
        echo "<script>window.setTimeout(function(){ window.location.href = 'anasayfa.html'; }, 3000);</script>";
    } else {
        $error_message = "Kullanıcı adı veya şifre yanlış!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>
    <link href="css/giriş.css" rel="stylesheet" type="text/css">
    <link href="css/anasayfa.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="anasayfa.html">Ana Sayfa</a>
            <a href="özgeçmiş.html">Özgeçmiş</a>
            <a href="şehrim.html">Şehrim</a>
            <a href="ilgialanlarım.html">İlgi Alanlarım</a>
            <a href="iletişim.html">İletişim</a>
            <a href="giriş.php" class="active">Giriş</a>
        </div>
        <h1>Giriş</h1>

        <?php if ($loggedIn): ?>
            <p style="color: green;">Hoşgeldiniz g231210077</p>
        <?php else: ?>
            <?php if (!empty($error_message)): ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <!-- Giriş formu -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="username">Kullanıcı Adı (E-posta):</label>
                <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($input_username ?? ''); ?>">

                <label for="password">Şifre:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" value="Giriş">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
