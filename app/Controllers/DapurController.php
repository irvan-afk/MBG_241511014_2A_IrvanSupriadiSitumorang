<?php

namespace App\Controllers;

use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;
use App\Models\GudangModel;

class DapurController extends BaseController
{
    public function create()
    {
        $gudangModel = new GudangModel();

        $bahan = $gudangModel
            ->where('jumlah >', 0)
            ->where('status !=', 'kadaluarsa')
            ->findAll();

        return view('dapur/create_permintaan', ['bahan' => $bahan]);
    }

    public function store()
    {
        $permintaanModel = new PermintaanModel();
        $detailModel = new PermintaanDetailModel();

        $pemohon_id = session()->get('id');

        $permintaanData = [
            'pemohon_id'   => $pemohon_id,
            'tgl_masak'    => $this->request->getPost('tgl_masak'),
            'menu_makan'   => $this->request->getPost('menu_makan'),
            'jumlah_porsi' => $this->request->getPost('jumlah_porsi'),
            'status'       => 'menunggu',
            'created_at'   => date('Y-m-d H:i:s')
        ];

        $permintaanModel->insert($permintaanData);
        $permintaan_id = $permintaanModel->getInsertID();

        $bahan_id = $this->request->getPost('bahan_id');
        $jumlah_diminta = $this->request->getPost('jumlah_diminta');

        if (is_array($bahan_id) && is_array($jumlah_diminta)) {
            foreach ($bahan_id as $index => $idBahan) {
                if (!empty($idBahan) && !empty($jumlah_diminta[$index])) {
                    $detailModel->insert([
                        'permintaan_id'   => $permintaan_id,
                        'bahan_id'        => $idBahan,
                        'jumlah_diminta'  => $jumlah_diminta[$index]
                    ]);
                }
            }
        }

        return redirect()->to('/dapur/permintaan/status')
            ->with('success', 'Permintaan berhasil dikirim!');
    }

    public function status()
    {
        $permintaanModel = new PermintaanModel();

        $data['permintaan'] = $permintaanModel
            ->orderBy('created_at', 'DESC')
            ->findAll();
        return view('dapur/status_permintaan', $data);
    }
}
