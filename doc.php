<!--<?php
$connection = mysqli_connect("localhost", "root", "", "db_filesharing");
if (!$connection) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}

$id = $_GET['id']; // Mendapatkan ID file dari URL, misalnya doc.php?id=1

$query = "SELECT filename, content FROM files WHERE id = $id";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $filename = $row['filename'];
  $content = $row['content'];
} else {
  echo "File not found.";
}

?>-->

<!DOCTYPE html>
<html>
<head>
  <title>File Sharing - Dokumen</title>
</head>
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
    <h1>Sistem File Sharing </h1>
    <nav>
      <ul>
        <li><a href="beranda.php">Home</a></li>
        <li><a href="sharing.php">File Sharing</a></li>
        <li><a href="acc.php">Akun Saya</a></li>
      </ul>
    </nav>
  </header>
  
  <div class="container">
    <h2>Daftar File Dokumen</h2>

    <?php
    // Step 1: Koneksi ke database
    $connection = mysqli_connect("localhost", "root", "", "db_filesharing");
    if (!$connection) {
      die("Koneksi database gagal: " . mysqli_connect_error());
  }

  // Step 2: Mengambil data file dokumen dari tabel "files" dengan format dokumen yang diinginkan
  $documentFormats = array(
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/vnd.ms-excel',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'application/vnd.ms-powerpoint',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation'
  );
  $formatConditions = implode("', '", $documentFormats);
  $query = "SELECT id, filename FROM files WHERE filetype IN ('$formatConditions')";
  $result = mysqli_query($connection, $query);

  // Step 3: Menampilkan daftar file dokumen
  if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $fileId = $row['id'];
      $filename = $row['filename'];

      echo "<p><a href='downloaddoc.php?id=" . urlencode($fileId) . "'>$filename</a></p>";
    }
  } else {
    echo "Tidak ada file Dokumen yang ditemukan.";
  }

  // Step 4: Menutup koneksi ke database
  mysqli_close($connection);
  ?>
  </div>

  <footer>
    &copy; 2023 Sistem File Sharing. All rights reserved.
  </footer>
</body>
</html>
