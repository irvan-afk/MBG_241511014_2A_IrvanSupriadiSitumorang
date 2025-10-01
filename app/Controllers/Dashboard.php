<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $session = session();
        $userRole = $session->get('role');

        if ($userRole === 'gudang') {
            return view('gudang');
        } else if ($userRole === 'dapur') {
            return view('dapur');
        } else {
            return redirect()->to('/');
        }
    }
}