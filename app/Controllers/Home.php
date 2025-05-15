<?php

namespace App\Controllers;

use App\Models\ProductModel; 

class Home extends BaseController
{
    protected $product;

    function __construct()
    {
        $this->product = new ProductModel();
    }

    public function index(): string
    {
        $product = $this->product->findAll();
        $data['product'] = $product;

        return view('v_home', $data);
    }

    public function contact()
    {
        return view('v_contact');
    }

    public function submitContact()
    {
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $pesan = $this->request->getPost('pesan');

        // Simulasi penyimpanan, nanti bisa dikirim ke DB atau email
        session()->setFlashdata('success', 'Pesan berhasil dikirim!');

        return redirect()->to('contact');
    }

}
