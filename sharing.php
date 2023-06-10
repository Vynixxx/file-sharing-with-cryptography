<!DOCTYPE html>
<html>
<head>
  <title>File Sharing - Sharing</title>
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

a:link { text-decoration: none; }

h2 {
  margin-bottom: 20px;
}

.file-list {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

.file {
  background-color: #f5f5f5;
  padding: 10px;
  border-radius: 5px;
  text-align: center;
}

.file img {
  width: 80px;
  height: 80px;
  margin-bottom: 10px;
}

footer {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
  margin-top: auto;
}

#file-input {
  display: none;
}

#upload-btn {
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

#upload-btn:hover {
  background-color: #555;
}

#upload-btn:active {
  background-color: #222;
}

.custom-upload {
  display: inline-block;
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.custom-upload:hover {
  background-color: #555;
}

.custom-upload:active {
  background-color: #222;
}

.custom-upload-label {
  display: inline-block;
  border: 1px solid #ccc;
  padding: 6px 12px;
  cursor: pointer;
}

.custom-upload-label:hover {
  background-color: #f5f5f5;
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
    <h2>File Sharing</h2>
    <div class="file-list">
        <div class="file">
            <a href="video.php"><img src="2.png" alt="Video Icon"></a>
            <a href="video.php"><p>Video</p></a>
          </div>
          <div class="file">
            <a href="doc.php"><img src="p.png" alt="Document Icon"></a>
            <a href="doc.php"><p>Document</p></a>
          </div>
          <div class="file">
            <a href="img.php"><img src="i.png" alt="Image Icon"></a>
            <a href="img.php"><p>Image</p></a>
          </div>    
        </div>
    
    
    <h3>Unggah File</h3>
    <form enctype="multipart/form-data" method="post" action="upload.php" id="upload-form">
        <input type="file" name="file" required>
        <input type="submit" value="Unggah" id="upload-btn">
    </form>
  </div>


  <footer>
    &copy; 2023 Sistem File Sharing. All rights reserved.
  </footer>

  </script>
</body>
</html>
