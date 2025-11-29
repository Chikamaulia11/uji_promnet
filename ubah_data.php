<?php
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require("function.php");

// ambil id buku dari URL
$id = $_GET['id_buku'];

// ambil data buku
$buku = query("SELECT * FROM buku WHERE id_buku = $id")[0];

// jika tombol submit ditekan
if(isset($_POST['tombol_submit'])) {

    if(ubah_data($_POST) > 0){
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'index.php';
              </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ubah Data Buku</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container p-4">
    <h1 class="mb-3">Ubah Data Buku</h1>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">
        <input type="hidden" name="cover_lama" value="<?= $buku['cover']; ?>">

        <div class="mb-3">
            <label class="form-label">Nama Buku</label>
            <input type="text" class="form-control" name="nama_buku" value="<?= $buku['nama_buku']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" class="form-control" name="penulis" value="<?= $buku['penulis']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori Buku</label>
            <select name="id_kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="1" <?= $buku['id_kategori']==1?'selected':'' ?>>Fiksi</option>
                <option value="2" <?= $buku['id_kategori']==2?'selected':'' ?>>Non Fiksi</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="3"><?= $buku['deskripsi']; ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" value="<?= $buku['harga']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok" value="<?= $buku['stok']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cover</label>
            <input type="file" class="form-control" name="cover">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Input</label>
            <input type="date" class="form-control" name="tanggal_input" value="<?= $buku['tanggal_input']; ?>" required>
        </div>

        <button class="btn btn-primary" name="tombol_submit">Submit</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
