<?php
require("function.php");
$id = $_GET['id_kategori'];
if(hapus_kategori($id) > 0){
    echo "<script>alert('Kategori berhasil dihapus');window.location='index_kategori.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus kategori');window.location='index_kategori.php';</script>";
}
