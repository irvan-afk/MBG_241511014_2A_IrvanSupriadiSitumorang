<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Permintaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand">Dapur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(session()->get('isLoggedIn')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('/dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('dapur/permintaan/create') ?>">Permintaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= site_url('/dapur/permintaan/status') ?>">status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('/logout') ?>">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <h3>Riwayat Permintaan Bahan</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Menu</th>
                <th>Jumlah Porsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($permintaan as $p): ?>
            <tr>
                <td><?= $p['tgl_masak'] ?></td>
                <td><?= $p['menu_makan'] ?></td>
                <td><?= $p['jumlah_porsi'] ?></td>
                <td>
                    <?php if ($p['status'] == 'menunggu'): ?>
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    <?php elseif ($p['status'] == 'disetujui'): ?>
                        <span class="badge bg-success">Disetujui</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Ditolak</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
