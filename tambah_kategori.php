<?php
require("function.php");

if(isset($_POST['tambah'])){
    if(tambah_kategori($_POST) > 0){
        echo "<script>alert('Kategori berhasil ditambahkan');window.location='index_kategori.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan kategori');</script>";
    }
}
?>

<form method="POST">
    <label>Nama Kategori</label>
    <input type="text" name="nama_kategori" required>
    <button type="submit" name="tambah">Tambah</button>
</form>
