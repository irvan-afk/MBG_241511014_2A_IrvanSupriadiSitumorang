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
        <h4>Edit Bahan Baku</h4>
    </div>
    <div class="card-body">
        <?php if(session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('gudang/update/' . $bahanBaku['id']) ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="<?= esc($bahanBaku['nama']) ?>">
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="form-control"
                    value="<?= esc($bahanBaku['kategori']) ?>">
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control"
                    value="<?= esc($bahanBaku['jumlah']) ?>">
            </div>

            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <select name="satuan" id="satuan" class="form-select">
                    <option value="kg" <?= ($bahanBaku['satuan'] == 'kg') ? 'selected' : '' ?>>Kg</option>
                    <option value="liter" <?= ($bahanBaku['satuan'] == 'liter') ? 'selected' : '' ?>>Liter</option>
                    <option value="butir" <?= ($bahanBaku['satuan'] == 'butir') ? 'selected' : '' ?>>Butir</option>
                    <option value="ikat" <?= ($bahanBaku['satuan'] == 'ikat') ? 'selected' : '' ?>>Ikat</option>
                    <option value="potong" <?= ($bahanBaku['satuan'] == 'potong') ? 'selected' : '' ?>>Potong</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control"
                    value="<?= esc($bahanBaku['tanggal_masuk']) ?>">
            </div>

            <div class="mb-3">
                <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" class="form-control"
                    value="<?= esc($bahanBaku['tanggal_kadaluarsa']) ?>">
            </div>

            <a href="<?= site_url('gudang') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>