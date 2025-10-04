<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Bahan Baku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h4>Konfirmasi Penghapusan</h4>
        </div>
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus bahan baku berikut?</p>

            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Nama:</strong> <?= esc($bahanBaku['nama']) ?></li>
                <li class="list-group-item"><strong>Kategori:</strong> <?= esc($bahanBaku['kategori']) ?></li>
                <li class="list-group-item"><strong>Jumlah:</strong> <?= esc($bahanBaku['jumlah']) ?></li>
                <li class="list-group-item"><strong>Satuan:</strong> <?= esc($bahanBaku['satuan']) ?></li>
                <li class="list-group-item"><strong>Tanggal Masuk:</strong> <?= esc($bahanBaku['tanggal_masuk']) ?></li>
                <li class="list-group-item"><strong>Tanggal Kadaluarsa:</strong> <?= esc($bahanBaku['tanggal_kadaluarsa']) ?></li>
                <li class="list-group-item"><strong>Status:</strong> <?= esc($bahanBaku['status']) ?></li>
            </ul>

            <form action="<?= site_url('gudang/delete/' . $bahanBaku['id']) ?>" method="post">
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                <a href="<?= site_url('gudang') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
