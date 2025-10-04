<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek apakah user sudah login
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Jika filter dipanggil dengan role tertentu, cek rolenya
        if ($arguments && isset($arguments[0])) {
            $allowedRole = $arguments[0];
            if ($session->get('role') !== $allowedRole) {
                return redirect()->to('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
