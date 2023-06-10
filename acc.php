<?php 
require 'conn.php';
 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
// Ambil email dari database berdasarkan username
$username = $_SESSION['username'];
$query = "SELECT email FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
} else {
    $email = "Email tidak ditemukan";
}

if (isset($_POST['logout'])) {
  // Hapus semua data sesi
  session_destroy();
  
  // Arahkan pengguna kembali ke halaman login
  header("Location: index.php");
  exit();
}
// Tutup koneksi database
mysqli_close($conn);
 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sistem File Sharing - Akun Saya</title>
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

h2 {
  margin-bottom: 20px;
}

form {
  max-width: 400px;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 10px;
}

input[type="submit"] {
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #555;
}

input[type="submit"]:disabled {
  background-color: #999;
  cursor: not-allowed;
}

button {
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
  
footer {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
  margin-top: auto;
}

</style>
<body>
  <header>
    <h1>Sistem File Sharing</h1>
    <nav>
      <ul>
        <li><a href="beranda.php">Home</a></li>
        <li><a href="sharing.php">File Sharing</a></li>
        <li><a href="acc.php">Akun Saya</a></li>
      </ul>
    </nav>
  </header>
  
  <div class="container">
    <h2>Akun Saya</h2>
    <form>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" readonly>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>

    </form>

    <form method="post">
      <button type="submit" name="logout">Keluar</button>
    </form>
  </div>

  <footer>
    &copy; 2023 Sistem File Sharing. All rights reserved.
  </footer>
</body>
</html>
