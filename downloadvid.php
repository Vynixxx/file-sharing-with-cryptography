<?php
// Koneksi ke database
$databaseHost = 'localhost'; // Ganti dengan host database Anda
$databaseName = 'db_filesharing';
$databaseUser = 'root'; // Ganti dengan username database Anda
$databasePassword = ''; // Ganti dengan password database Anda

$database = new mysqli($databaseHost, $databaseUser, $databasePassword, $databaseName);
if ($database->connect_error) {
    die("Koneksi ke database gagal: " . $database->connect_error);
}

// Mendapatkan ID file dari parameter URL
if (isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Query database untuk mendapatkan informasi file
    $query = "SELECT * FROM files WHERE id = '$fileId'";
    $result = $database->query($query);

    if ($result && $result->num_rows > 0) {
        $fileData = $result->fetch_assoc();

        $filename = $fileData['filename'];
        $encryptedContent = $fileData['content'];

        // Mendekripsi konten file
        $decryptionKey = '@AndaKepoSekaliTampaknya88218'; // kunci enkripsi 
        $encryptedText = base64_decode($encryptedContent);
        $decryptedText = aesDecrypt($encryptedText, $decryptionKey); // Menggunakan metode AES

        // Mengirimkan video ke pengguna
        header("Content-Type: video/mp4"); // Sesuaikan dengan tipe file yang diunduh
        header("Content-Disposition: attachment; filename=\"$filename\"");
        echo $decryptedText;
        exit();
    } else {
        echo "File tidak ditemukan.";
    }
} else {
    echo "ID file tidak diberikan.";
}

// Fungsi untuk mendekripsi file menggunakan metode kriptografi AES (Advanced Encryption Standard)
function aesDecrypt($ciphertext, $key) {
    $ciphertext = base64_decode($ciphertext);
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($ciphertext, 0, $ivSize);
    $ciphertext = substr($ciphertext, $ivSize);
    $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return $plaintext;
}

// Tutup koneksi database
$database->close();
?>
