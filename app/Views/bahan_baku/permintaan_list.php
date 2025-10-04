<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Permintaan Bahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand">Dashboard Gudang</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if(session()->get('isLoggedIn')): ?>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('/dashboard') ?>">Dashboard</a> </li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('/gudang') ?>">Cek Gudang</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= site_url('/gudang/permintaan') ?>">Permintaan</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('/logout') ?>">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h3 class="mb-4">Daftar Permintaan Bahan</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (empty($permintaan)): ?>
        <div class="alert alert-info">Tidak ada permintaan yang menunggu persetujuan.</div>
    <?php else: ?>
        <?php foreach ($permintaan as $req): ?>
            <div class="card mb-3">
                <div class="card-header bg-secondary text-white">
                    Permintaan #<?= $req['id'] ?> oleh <?= esc($req['pemohon']) ?> | Menu: <?= esc($req['menu_makan']) ?>
                </div>
                <div class="card-body">
                    <p><strong>Tanggal Masak:</strong> <?= esc($req['tgl_masak']) ?></p>
                    <p><strong>Jumlah Porsi:</strong> <?= esc($req['jumlah_porsi']) ?></p>

                    <h6>Detail Bahan Diminta:</h6>
                    <ul>
                        <?php foreach ($req['detail'] as $d): ?>
                            <li><?= esc($d['nama_bahan']) ?>: <?= esc($d['jumlah_diminta']) . ' ' . esc($d['satuan']) ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="d-flex gap-2">
                        <form action="<?= site_url('gudang/permintaan/setujui/' . $req['id']) ?>" method="post">
                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                        </form>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolakModal<?= $req['id'] ?>">
                            Tolak
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="tolakModal<?= $req['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="<?= site_url('gudang/permintaan/tolak/' . $req['id']) ?>" method="post" class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Tolak Permintaan #<?= $req['id'] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label>Alasan Penolakan:</label>
                            <textarea name="alasan" class="form-control" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
