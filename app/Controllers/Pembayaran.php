<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\SewaModel;
use App\Models\KamarModel;
use App\Models\StatusPembelianModel;
use App\Models\UserModel;
use App\Models\DaftarStatusModel;

class Pembayaran extends BaseController
{
    protected $modelSewa;
    protected $modelKamar;
    protected $modelStatusPembelian;
    protected $modelDaftarStatus;
    protected $modelUser;
    protected $session;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->modelKamar = new KamarModel();
        $this->modelSewa = new SewaModel();
        $this->modelStatusPembelian = new StatusPembelianModel();
        $this->modelDaftarStatus = new DaftarStatusModel();
        $this->modelUser = new UserModel();
    }


    public function menunggu()
    {
        $daftarstatuspembelian = $this->modelStatusPembelian->getStatusPembelianByIdFindAll(1);
        $status = $this->modelDaftarStatus->findAll();
        $data = [
            'title' => 'Daftar Pembayaran Menunggu',
            'daftar_status_pembelian' => $daftarstatuspembelian,
            'daftar_status' => $status,
        ];
        return view('admin/menunggu', $data);
    }

    public function update($id)
    {

        $status_id = $this->request->getVar('status_id');
        $user_id = $this->request->getVar('user_id');
        $kamar_id = $this->request->getVar('kamar_id');
        $transaksi = $this->request->getVar('transaksi');

        $modelstatus = $this->modelStatusPembelian;
        // Data yang ingin Anda simpan
        $data = [
            'status_id' => $status_id,
            'user_id' => $user_id,
            'kamar_id' => $kamar_id,
            'transaksi' => $transaksi
            // Sesuaikan dengan kolom-kolom yang ada di model Anda
        ];

        // Memasukkan data ke dalam model
        $modelstatus->update($id, $data);

        if ($status_id == 2) {
            return redirect()->to('/Pembayaran/diterima')->with('success', 'Status Pembayaran Berhasil Diubah');
        } elseif ($status_id == 2) {
            return redirect()->to('/Pembayaran/ditolak')->with('success', 'Status Pembayaran Berhasil Diubah');
        }
    }

    public function diterima()
    {
        $daftarstatuspembelian = $this->modelStatusPembelian->getStatusPembelianByIdFindAll(2);
        $status = $this->modelDaftarStatus->findAll();
        $data = [
            'title' => 'Daftar Pembayaran Diterima',
            'daftar_status_pembelian' => $daftarstatuspembelian,
            'daftar_status' => $status,
        ];
        return view('admin/diterima', $data);
    }

    public function ditolak()
    {
        $daftarstatuspembelian = $this->modelStatusPembelian->getStatusPembelianByIdFindAll(3);
        $status = $this->modelDaftarStatus->findAll();
        $data = [
            'title' => 'Daftar Pembayaran Ditolak',
            'daftar_status_pembelian' => $daftarstatuspembelian,
            'daftar_status' => $status,
        ];
        return view('admin/ditolak', $data);
    }
}
