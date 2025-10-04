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
        }

        $GudangModel->update($BahanBaku['id'], ['status' => $BahanBaku['status']]);

        $data['bahan_baku'] = $bahanBakuList;
        return view('bahan_baku/index', $data);
    }

    public function create()
    {
        return view('bahan_baku/create');
    }

    public function Store()
    {

    }
}