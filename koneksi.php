<?php
// Pastikan file koneksi.php sudah ada dan variabel $conn sudah terinisialisasi
include 'koneksi.php'; 

// 1. Ambil semua kategori, ORDER BY sudah menggunakan 'nama_kategori'
//    Pastikan 'nama_kategori' adalah nama kolom yang benar di tabel 'data_kategori'
$result = mysqli_query($conn, "SELECT * FROM data_kategori ORDER BY nama_kategori ASC");

// 2. Tambahkan pemeriksaan kesalahan query (opsional, tapi disarankan)
if (!$result) {
    die("Query Gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kategori</title>
</head>
<body>
    <h2>Daftar Kategori</h2>

    <a href="tambah_kategori.php">Tambah Kategori</a>
    <br><br>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    <?php 
        // Melakukan perulangan untuk menampilkan data
        while($row = mysqli_fetch_assoc($result)) : 
        ?>
        <tr>
            <td><?= $row['id_kategori'] ?></td>
            <td><?= $row['nama_kategori'] ?></td>
            <td>
                <a href="hapus_kategori.php?id=<?= $row['id_kategori'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </td> 
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>