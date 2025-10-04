<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GudangModel;
use DateTime;

class GudangController extends BaseController
{
    public function index()
    {
        $GudangModel = new GudangModel();
        $bahanBakuList = $GudangModel->findAll();

        $today = new DateTime();

        foreach ($bahanBakuList as $BahanBaku) {
            $jumlah = (int)$BahanBaku['jumlah'];
            $tanggalkadaluarsa = new DateTime($BahanBaku['tanggal_kadaluarsa']);

            if ($jumlah == 0) {
                $BahanBaku['status'] = 'habis';
            }

            elseif ($today >= $tanggalkadaluarsa) {
                $BahanBaku['status'] = 'kadaluarsa';
            }

            elseif ($today->diff($tanggalkadaluarsa)->days <= 3) {
                $BahanBaku['status'] = 'segera_kadaluarsa';
            }

            else {
                $BahanBaku['status'] = 'tersedia';
            }
            $GudangModel->update($BahanBaku['id'], ['status' => $BahanBaku['status']]);
        }

        $data['bahan_baku'] = $bahanBakuList;
        return view('bahan_baku/index', $data);
    }

    public function create()
    {
        return view('bahan_baku/create');
    }

    public function Store()
    {
        $GudangModel = new GudangModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|integer',
            'satuan' => 'required',
            'tanggal_masuk' => 'required|valid_date',
            'tanggal_kadaluarsa' => 'required|valid_date',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('name'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
        ];

        // ini dibuat untuk membuat status dari bahan baku menjadi otomatis menyesuaikan dengan waktu skrg
        $today = new \DateTime();
        $kadaluarsa = new \DateTime($data['tanggal_kadaluarsa']);
        $jumlah = (int)$data['jumlah'];

        if ($jumlah == 0) {
            $data['status'] = 'habis';
        } elseif ($today >= $kadaluarsa) {
            $data['status'] = 'kadaluarsa';
        } elseif ($today->diff($kadaluarsa)->days <= 3) {
            $data['status'] = 'segera_kadaluarsa';
        } else {
            $data['status'] = 'tersedia';
        }

        $GudangModel->insert($data);

        return redirect()->to(site_url('gudang'))->with('success', 'Bahan baku berhasil ditambahkan!');

    }
}