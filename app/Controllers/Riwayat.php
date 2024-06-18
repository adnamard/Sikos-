<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\SewaModel;
use App\Models\KamarModel;
use App\Models\StatusPembelianModel;
use App\Models\UserModel;

class Riwayat extends BaseController
{
    protected $modelSewa;
    protected $modelKamar;
    protected $modelStatusPembelian;
    protected $modelUser;
    protected $session;

    public function __construct()
    {

        $this->session = \Config\Services::session();
        $this->modelKamar = new KamarModel();
        $this->modelSewa = new SewaModel();
        $this->modelStatusPembelian = new StatusPembelianModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        if ($this->session->has('userData')) {
            $userID = $this->session->get('userData')['id'];

            // Mengambil semua riwayat transaksi user dari tabel status pembelian
            $riwayatTransaksi = $this->modelStatusPembelian
                ->select('status_pembelian.*, kamar.*, user.username, user.email, daftar_status.*, status_pembelian.id')
                ->join('user', 'user.id = status_pembelian.user_id')
                ->join('kamar', 'kamar.id = status_pembelian.kamar_id')
                ->join('daftar_status', 'daftar_status.id = status_pembelian.status_id')
                ->where('status_pembelian.user_id', $userID)
                ->orderBy('status_pembelian.id', 'DESC')
                ->findAll();

            $tanggalPembelian = [];

            foreach ($riwayatTransaksi as $transaksi) {
                $tanggalPembelian[] = $transaksi['tanggal_pembelian'];
            }

            $data = [
                'riwayatTransaksi' => $riwayatTransaksi,
                'tanggalPembelian' => $tanggalPembelian,
                'title' => 'Riwayat Transaksi'
                // Anda bisa menambahkan data lainnya yang ingin ditampilkan di view di sini
            ];
            // dd($data);
            return view('user/riwayat', $data);
        }
    }
}
