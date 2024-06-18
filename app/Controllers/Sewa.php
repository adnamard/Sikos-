<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\SewaModel;
use App\Models\KamarModel;
use App\Models\StatusPembelianModel;

class Sewa extends BaseController
{
    protected $modelSewa;
    protected $modelKamar;
    protected $modelStatusPembelian;
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->modelKamar = new KamarModel();
        $this->modelSewa = new SewaModel();
        $this->modelStatusPembelian = new StatusPembelianModel();
    }
    public function index()
    {
        $userId = $this->session->get('userData.id');
        $sewa = $this->modelSewa->getSewaById($userId);

        if ($sewa == null) {
            return redirect()->to(base_url('/'))->with('error', 'Belum ada kamar yang dipilih nih, pilih dulu yuk!');
        }

        // Menghitung total harga komik
        $totalHarga = 0;
        foreach ($sewa as $c) {
            // Ambil harga komik dari database berdasarkan ID komik
            $hargaSewa = $this->modelKamar->find($c['kamar_id'])['harga'];

            // Hitung total harga dengan mengakumulasikan harga setiap komik
            $totalHarga += $hargaSewa * $c['jumlah'];
        }
        $data = [
            'title' => 'Keranjang | Komikin',
            'sewa' => $sewa,
            'user' => $userId,
            'totalHarga' => $totalHarga
        ];
        return view('user/sewa', $data);
    }

    public function add($id)
    {
        // Periksa apakah pengguna sudah login
        if ($this->session->has('userData')) {
            // Ambil ID barang dari parameter
            $kamarID = $id;

            // Ambil ID user dari session
            $userID = $this->session->get('userData')['id'];

            // Hitung jumlah barang yang sudah ada dalam keranjang
            $sewaAda = $this->modelSewa->getSewaById($userID);
            $jumlahSewa = count($sewaAda);

            foreach ($sewaAda as $sewaItem) {
                if ($sewaItem['kamar_id'] == $kamarID) {
                    return redirect()->to(base_url('/'))->with('error', 'Kamar ini sudah ada dalam keranjang lho.');
                }
            }
            if ($jumlahSewa >= 1) {
                return redirect()->to(base_url('/'))->with('error', 'Eits, selesaikan pembayaran sewa dulu yuk!');
            }
            // Ambil informasi barang untuk mendapatkan stok saat ini
            $kamar = $this->modelKamar->find($kamarID);

            // Periksa apakah stok cukup untuk menambahkan ke keranjang
            if ($kamar['stok'] > 0) {
                // Jika tidak ada barang dalam keranjang, tambahkan barang yang dipilih ke keranjang
                $checkoutData = [
                    'user_id' => $userID,
                    'kamar_id' => $kamarID,
                    'jumlah' => 1, // Default jumlah 1 jika tidak ditentukan
                ];

                // Tambahkan ke keranjang
                $this->modelSewa->insertSewa($checkoutData);

                // Setelah menambahkan barang ke keranjang, tampilkan pesan bahwa produk berhasil ditambahkan
                return redirect()->to(base_url('/'))->with('success', 'Kamar berhasil ditambahkan ke keranjang');
            } else {
                // Jika stok tidak mencukupi, tampilkan pesan error
                return redirect()->to(base_url('/'))->with('error', 'Kamar tidak tersedia');
            }
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->to(base_url('auth/halamanlogin'))->with('error', 'Silakan login terlebih dahulu');
        }
    }

    public function bayar()
    {
        if ($this->session->has('userData')) {
            $userID = $this->session->get('userData')['id'];
            $username = $this->session->get('userData')['username'];
            $checkout = $this->modelSewa->getSewaById($userID);
            $bukti_pembayaran = $this->request->getFile('buktiPembayaran');


            $bayarKeberapasiClient = $this->modelStatusPembelian
                ->select('status_pembelian.*')
                ->where('user_id', $userID)
                ->orderBy('transaksi', 'DESC')
                ->first();

            $bayarKeberapa = 0;
            if ($bayarKeberapasiClient == null) {
                $bayarKeberapa = 1;
            } else {
                $bayarKeberapa = $bayarKeberapasiClient['transaksi'] + 1;
            }


            if ($bukti_pembayaran->isValid() && !$bukti_pembayaran->hasMoved()) {
                $bukti = $bukti_pembayaran->getRandomName();
                $bukti_pembayaran->move('img', $bukti);
            }
            // Mengambil informasi waktu sekarang
            $dataPembelian = [];


            foreach ($checkout as $item) {
                $dataPembelian[] = [
                    'kamar_id' => $item['kamar_id'],
                    'user_id' => $userID,
                    'jumlah' => $item['jumlah'],
                    'status_id' => 1,
                    'transaksi' => $bayarKeberapa,
                    'bukti_pembayaran' => $bukti,
                ];
            }

            // Simpan setiap data pembelian ke dalam tabel
            foreach ($dataPembelian as $data) {
                $this->modelStatusPembelian->insert($data);
            }

            $this->modelSewa->where('user_id', $userID)->delete();
            // var_dump($checkout);
            return redirect()->to('/')->with('success', 'Pembayaran berhasil dilakukan. Silahkan Menunggu konfirmasi dari admin');
        }
    }



    public function delete($checkoutId)
    {
        // Periksa apakah pengguna sudah login
        if ($this->session->has('userData')) {
            // Ambil ID checkout dari parameter
            $checkoutItem = $this->modelSewa->find($checkoutId);

            // Debugging: Check if $checkoutItem is correctly retrieved
            if (!$checkoutItem) {
                return redirect()->to(base_url('/'))->with('error', 'Item tidak ditemukan di keranjang');
            }

            // Ambil ID barang dari item checkout
            if (!isset($checkoutItem['kamar_id'])) {
                return redirect()->to(base_url('/'))->with('error', 'Data item tidak valid, kamar_id tidak ditemukan');
            }

            $kamarID = $checkoutItem['kamar_id'];

            // Ambil ID user dari session
            $userID = $this->session->get('userData')['id'];

            // Hapus barang dari keranjang
            $deleted = $this->modelSewa->deleteSewa($checkoutId);

            if ($deleted) {
                // Kembalikan stok barang di database
                $barang = $this->modelKamar->find($kamarID);
                $this->modelKamar->update($kamarID, ['stok' => $barang['stok'] + $checkoutItem['jumlah']]);

                return redirect()->to(base_url('/'))->with('success', 'Kamar berhasil dihapus dari keranjang');
            } else {
                return redirect()->to(base_url('/'))->with('error', 'Gagal menghapus barang dari keranjang');
            }
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->to(base_url('auth/halamanlogin'))->with('error', 'Silakan login terlebih dahulu');
        }
    }
}
