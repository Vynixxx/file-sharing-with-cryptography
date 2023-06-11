<?php
// Fungsi untuk mengenkripsi file menggunakan metode kriptografi Caesar Cipher
function caesarCipherEncrypt($plaintext, $shift) {
    $ciphertext = '';
    $length = strlen($plaintext);
    for ($i = 0; $i < $length; $i++) {
        $char = $plaintext[$i];
        if (ctype_alpha($char)) {
            $asciiOffset = ord(ctype_upper($char) ? 'A' : 'a');
            $cipherAscii = fmod($asciiOffset + ((ord($char) - $asciiOffset + $shift) % 26), 26) + $asciiOffset;
            $ciphertext .= chr($cipherAscii);
        } else {
            $ciphertext .= $char;
        }
    }
    return $ciphertext;
}

// Fungsi untuk mengenkripsi file menggunakan metode kriptografi AES (Advanced Encryption Standard)
function aesEncrypt($plaintext, $key) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $ciphertext);
}

// Fungsi untuk mengenkripsi dan menyimpan file ke dalam database
function encryptAndSaveFile($file, $key, $database) {
    $filename = $file['name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];

    $plaintext = file_get_contents($file['tmp_name']);
    $encryptedText = caesarCipherEncrypt($plaintext, 3); // Menggunakan metode Caesar Cipher
    $encryptedText = aesEncrypt($encryptedText, $key); // Menggunakan metode AES

    $encryptedContent = $database->real_escape_string($encryptedText);

    $query = "INSERT INTO files (filename, filesize, filetype, content) VALUES ('$filename', '$fileSize', '$fileType', '$encryptedContent')";
    $result = $database->query($query);

    return $result;
}

// Koneksi ke database
$databaseHost = 'localhost';
$databaseName = 'db_filesharing';
$databaseUser = 'root'; 
$databasePassword = ''; 

$database = new mysqli($databaseHost, $databaseUser, $databasePassword, $databaseName);
if ($database->connect_error) {
    die("Koneksi ke database gagal: " . $database->connect_error);
}

// Proses unggah file jika ada file yang diunggah
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK && isset($_POST['encryption-key'])) {
    $uploadedFile = $_FILES['file'];
    $encryptionKey = $_POST['encryption-key']; // Kunci enkripsi dari input pengguna

    $result = encryptAndSaveFile($uploadedFile, $encryptionKey, $database);
    if ($result) {
        // Redirect ke halaman sharing.php setelah pengunggahan berhasil
        header("Location: sharing.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan file.";
    }
} else {
    echo "Terjadi kesalahan saat mengunggah file atau tidak ada kunci enkripsi yang diberikan.";
}

// Tutup koneksi database
$database->close();
?>
