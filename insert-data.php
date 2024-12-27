<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] ==='POST') {
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $prodi = $_POST['prodi'];
  $ukt = $_POST['ukt'];

  $query = "INSERT INTO datamhs (nim, nama, alamat, prodi, ukt) VALUES ('$nim', '$nama', '$alamat', '$prodi', '$ukt')";
  mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa</title>
  <link rel="stylesheet" href="insert-data-mahasiswa/insert_data.css">
  <link rel="icon" href="./photo/UNJ.png">
</head>
<body>
    <header>
        <h1>DATA MAHASISWA</h1>
        <nav>
          <a href="insert-data.php">Insert</a>
          <a href="view-data.php">View</a>
        </nav>
    </header>
  <div class="container">
    <main>
      <h2>Masukkan Data Mahasiswa</h2>
      <form action="insert-data.php" method="POST">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" required>
        </div>
        <div class="form-group">
          <label for="nim">NIM</label>
          <input type="text" id="nim" name="nim" required>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <input type="text" id="alamat" name="alamat" rows="3" required></input>
        </div>
        <div class="form-group">
          <label for="prodi">Prodi</label>
          <input type="text" id="prodi" name="prodi" required>
        </div>
        <div class="form-group">
          <label for="ukt">UKT</label>
          <input type="number" id="ukt" name="ukt" required>
        </div>
        <button type="submit">Tambah</button>
      </form>
    </main>
  </div>
</body>
</html>
