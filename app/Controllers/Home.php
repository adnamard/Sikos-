<?php

namespace App\Controllers;

use App\Models\KamarModel;

class Home extends BaseController
{
    protected $kamarModel;

    protected $session;


    public function __construct()
    {
        $this->kamarModel = new KamarModel();
        $this->session = \Config\Services::session();
    }
    public function index(): string
    {
        $data = [
            'title' => 'Sikost ^_^',
            'kamar' => $this->kamarModel->getKamar()
        ];
        return view('home', $data);
    }
}
