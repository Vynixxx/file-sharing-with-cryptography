<?php 
 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
?>

<!DOCTYPE html>
<html>
<head>
  <title>File Sharing - Home</title>
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
  <?php echo "<h2>Selamat Datang di Sistem File Sharing, " . $_SESSION['username'] ."!". "</h2>"; ?>
    <p>Anda dapat menggunakan sistem ini untuk mengunggah, mengunduh, dan berbagi file secara aman dengan pengguna lain.</p>
  </div>

  <footer>
    &copy; 2023 Sistem File Sharing. All rights reserved.
  </footer>
</body>
</html>
