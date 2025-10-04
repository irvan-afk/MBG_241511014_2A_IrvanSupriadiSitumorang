<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userRole = $session->get('role');

        if ($userRole === 'gudang') {
            return view('gudang');
        } else if ($userRole === 'dapur') {
            return view('dapur');
        } else {
            $session->destroy();
            return redirect()->to('/');
        }
    }
}