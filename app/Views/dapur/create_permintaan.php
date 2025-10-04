<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Permintaan Bahan - Dapur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script>
        function addRow() {
            const firstRow = document.querySelector('.bahan-row');
            const newRow = firstRow.cloneNode(true);

            newRow.querySelectorAll('input, select').forEach(el => el.value = '');

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';


            removeBtn.className = 'btn btn-danger btn-sm col-md-2';
            removeBtn.textContent = 'X';
            removeBtn.onclick = function() {
                if (document.querySelectorAll('.bahan-row').length > 1) {
                    newRow.remove();
                } else {
                    alert('Minimal satu bahan harus ada!');
                }
            };

            if (!newRow.querySelector('.btn-danger')) {
                const col = document.createElement('div');
                col.className = 'col-md-2 d-flex align-items-center';
                col.appendChild(removeBtn);
                newRow.appendChild(col);

            }

            document.querySelector('#bahan-list').appendChild(newRow);
        }

        function addRemoveButtonsToExistingRows() {
            const rows = document.querySelectorAll('.bahan-row');
            rows.forEach((row, index) => {

                if (index > 0 && !row.querySelector('.btn-danger')) {
                    const col = document.createElement('div');
                    col.className = 'col-md-2 d-flex align-items-center';

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'btn btn-danger btn-sm';
                    removeBtn.textContent = 'X';
                    removeBtn.onclick = () => row.remove();

                    col.appendChild(removeBtn);
                    row.appendChild(col);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', addRemoveButtonsToExistingRows);
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand">Dapur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(session()->get('isLoggedIn')): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('/dashboard') ?>">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= site_url('dapur/permintaan/create') ?>">Permintaan</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('/dapur/permintaan/status') ?>">Status</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('/logout') ?>">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h3 class="mb-4 text-center">Daftar Bahan Baku Tersedia</h3>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Bahan</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bahan)): ?>
                    <?php $no = 1; foreach ($bahan as $b): ?>
                        <?php if ($b['jumlah'] > 0 && $b['status'] != 'kadaluarsa'): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($b['nama']) ?></td>
                                <td><?= esc($b['kategori']) ?></td>
                                <td><?= esc($b['jumlah']) ?></td>
                                <td><?= esc($b['satuan']) ?></td>
                                <td><?= esc($b['tanggal_masuk']) ?></td>
                                <td><?= esc($b['tanggal_kadaluarsa']) ?></td>
                                <td>
                                    <?php if ($b['status'] == 'tersedia'): ?>
                                        <span class="badge bg-success">Tersedia</span>
                                    <?php elseif ($b['status'] == 'segera_kadaluarsa'): ?>
                                        <span class="badge bg-warning text-dark">Segera Kadaluarsa</span>
                                    <?php elseif ($b['status'] == 'habis'): ?>
                                        <span class="badge bg-secondary">Habis</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><?= esc($b['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">Tidak ada bahan tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <hr class="my-5">

        <h3 class="text-center mb-3">Form Permintaan Bahan Baku</h3>

        <form action="<?= site_url('/dapur/permintaan/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Tanggal Masak</label>
                <input type="date" name="tgl_masak" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Menu yang akan dibuat</label>
                <input type="text" name="menu_makan" class="form-control" placeholder="Contoh: Nasi Goreng Ayam" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Porsi</label>
                <input type="number" name="jumlah_porsi" class="form-control" min="1" required>
            </div>

            <h5 class="mb-3">Daftar Bahan yang Diminta</h5>

            <div id="bahan-list">
                <div class="row g-2 bahan-row mb-2">
                    <div class="col-md-6">
                        <select name="bahan_id[]" class="form-select" required>
                            <option value=""> Pilih Bahan </option>
                            <?php foreach ($bahan as $b): ?>
                                <?php if ($b['jumlah'] > 0 && $b['status'] != 'kadaluarsa'): ?>
                                    <option value="<?= $b['id'] ?>">
                                        <?= esc($b['nama']) ?> (stok: <?= esc($b['jumlah']) ?> <?= esc($b['satuan']) ?>)
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="jumlah_diminta[]" class="form-control" placeholder="Jumlah diminta" min="1" required>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary mb-3" onclick="addRow()">+ Tambah Bahan</button>
            <br>
            <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
        </form>
    </div>
</body>
</html>
