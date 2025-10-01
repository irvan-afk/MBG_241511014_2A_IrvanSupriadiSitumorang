<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GudangModel;

class GudangController extends BaseController
{
    public function index()
    {

        $session = session();
        $userRole = $session->get('role');

        if ($userRole != 'gudang') {
            return view('login');
        }

        $GudangModel = new GudangModel();
        $data['bahan_baku'] = $GudangModel->findAll();
        return view('bahan_baku/index', $data);
    }

    public function create()
    {

        return view('bahan_baku/create');
    }
}