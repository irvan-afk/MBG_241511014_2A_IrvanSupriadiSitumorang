<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>   
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand">Gudang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(session()->get('isLoggedIn')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('/logout') ?>">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('/login') ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4>Daftar bahan baku</h4>
                <a href="<?= site_url('BahanBaku/create') ?>" class="btn btn-primary btn-sm">tambah bahan baku</a>
            </div>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama </th>
                        <th>kategori</th>
                        <th>jumlah</th>
                        <th>satuan </th>
                        <th>tanggal_masuk </th>
                        <th>tanggal_kadaluarsa</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bahan_baku as $BahanBaku): ?>
                    <tr>
                        <td><?= $BahanBaku['id'] ?></td>
                        <td><?= esc($BahanBaku['nama']) ?></td>
                        <td><?= esc($BahanBaku['kategori']) ?></td>
                        <td><?= esc($BahanBaku['jumlah']) ?></td>
                        <td><?= esc($BahanBaku['satuan']) ?></td>
                        <td><?= esc($BahanBaku['tanggal_masuk']) ?></td>
                        <td><?= esc($BahanBaku['tanggal_kadaluarsa']) ?></td>
                        <td><?= esc($BahanBaku['status']) ?></td>
                        <td>
                            <a href="<?= site_url('BahanBaku/edit/' . $BahanBaku['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= site_url('BahanBaku/delete/' . $BahanBaku['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>