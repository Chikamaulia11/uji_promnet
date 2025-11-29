<?php
require("function.php");

// Pagination
$perPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perPage;

// Search
$keyword = $_GET['keyword'] ?? '';
$where = $keyword ? "WHERE nama_kategori LIKE '%$keyword%'" : "";

// Ambil total data untuk pagination
$totalData = count(query("SELECT * FROM kategori $where"));
$totalPage = ceil($totalData / $perPage);

// Ambil data kategori
$kategori = query("SELECT * FROM kategori $where ORDER BY id_kategori DESC LIMIT $start, $perPage");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori</title>
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="layout-fixed sidebar-expand-lg">
<div class="app-wrapper">
    <!-- Sidebar bisa di-copy dari index.php -->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
            <a href="index_kategori.php" class="brand-link">
                <img src="dist/assets/img/AdminLTELogo.png" alt="Logo" class="brand-image opacity-75 shadow">
                <span class="brand-text fw-light">Data Kategori</span>
            </a>
        </div>
    </aside>

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-3">Data Kategori</h3>
                        <a href="tambah_kategori.php">
                            <button class="btn btn-primary btn-sm">Tambah Kategori</button>
                        </a>
                    </div>
                    <div class="col-sm-6 d-flex flex-column align-items-end">
                        <form class="mt-2" method="GET">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Cari kategori..." value="<?= htmlspecialchars($keyword) ?>">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Kategori</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = $start + 1; ?>
                                <?php foreach($kategori as $data): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['id_kategori'] ?></td>
                                    <td><?= $data['nama_kategori'] ?></td>
                                    <td>
                                        <a href="ubah_kategori.php?id_kategori=<?= $data['id_kategori'] ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a href="hapus_kategori.php?id_kategori=<?= $data['id_kategori'] ?>" onclick="return confirm('Yakin ingin hapus?')" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <nav>
                            <ul class="pagination">
                                <?php for($i=1; $i<=$totalPage; $i++): ?>
                                    <li class="page-item <?= ($i==$page)?'active':'' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
