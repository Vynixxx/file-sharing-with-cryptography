<!DOCTYPE html>
<html>
<head>
  <title>File Sharing - Gambar</title>
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
    <h2>Daftar File Gambar</h2>

    <?php
    // Step 1: Koneksi ke database
    $connection = mysqli_connect("localhost", "root", "", "db_filesharing");
    if (!$connection) {
      die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Step 2: Mengambil data file gambar dari tabel "files"
    $query = "SELECT id, filename FROM files WHERE filetype IN ('image/png', 'image/jpeg', 'image/jpg')";
    $result = mysqli_query($connection, $query);

    // Step 3: Menampilkan daftar file gambar
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $fileId = $row['id'];
            $filename = $row['filename'];

            echo "<p><a href='downloadimg.php?id=$fileId'>$filename</a></p>";
        }
    } else {
        echo "Tidak ada file Gambar yang ditemukan.";
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
