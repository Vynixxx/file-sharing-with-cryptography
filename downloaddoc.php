<?php
// Step 1: Koneksi ke database
$connection = mysqli_connect("localhost", "root", "", "db_filesharing");
if (!$connection) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}

// Step 2: Memeriksa apakah ID file diberikan
if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Step 3: Mengambil data file dari database berdasarkan ID
    $query = "SELECT filename, content FROM files WHERE id = '$fileId'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $filename = $row['filename'];
        $encryptedContent = $row['content'];

        // Step 4: Meminta pengguna memasukkan kunci
        if (isset($_POST['encryption-key'])) {
            $encryptionKey = $_POST['encryption-key'];

            // Step 5: Mendekripsi konten file
            $decryptedContent = aesDecrypt(base64_decode($encryptedContent), $encryptionKey);

            // Step 6: Mengirim file ke pengguna
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            echo $decryptedContent;
            exit();
        }
?>

<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;   
  flex-direction: column;
  min-height: 100vh;
}

header {
  background-color: #333;
  color: #fff;
  padding: 20px;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

nav ul li {
  display: inline-block;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
  padding: 10px;
}

.container {
  width: 800px;
  margin: 0 auto;
  padding: 20px;
  flex: 1;
}

footer {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
}

</style>

<body>
  <header>
    <h1>Sistem File Sharing</h1>
  </header>
  
  <div class="container">
    <h2>Download File</h2>

    <form method="post" action="">
        <label for="encryption-key">Masukkan kunci:</label>
        <input type="password" name="encryption-key" required>
        <input type="submit" value="Download" id="download-btn">
    </form>
  </div>

  <footer>
    &copy; 2023 Sistem File Sharing. All rights reserved.
  </footer>
</body>

<?php
    } else {
        echo "File tidak ditemukan.";
    }
}

// Step 7: Menutup koneksi ke database
mysqli_close($connection);

// Fungsi untuk mendekripsi konten file menggunakan metode kriptografi AES (Advanced Encryption Standard)
function aesDecrypt($ciphertext, $key) {
    $ciphertextWithIV = base64_decode($ciphertext);
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($ciphertextWithIV, 0, $ivSize);
    $encryptedText = substr($ciphertextWithIV, $ivSize);
    return openssl_decrypt($encryptedText, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
}
?>
