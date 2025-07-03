<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function index()
    {
        $session = session();
        $data = [
            'title' => 'Profil Pengguna',
            'username' => $session->get('username') ?? 'sesuai dengan yang login',
            'role' => $session->get('role') ?? 'admin',
            'email' => $session->get('email') ?? '111202315413@mhs.dinus.ac.id',
            'waktu_login' => $session->get('waktu_login') ?? date('Y-m-d H:i:s'),
            'status' => $session->get('isLoggedIn') ? 'Sudah Login' : 'Belum Login',
        ];

        return view('v_contact', $data);
    }
}
