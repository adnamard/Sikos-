<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\KamarModel;


class Admin extends BaseController
{
    protected $session;
    protected $validation;
    protected $userModel;
    protected $kamarModel;

    public function __construct()
    {

        helper(['form']);

        $this->session = \Config\Services::session();
        $this->userModel  = new UserModel();
        $this->kamarModel  = new KamarModel();
    }


    public function index()
    {
        return view('admin/dashboard');
    }

    public function daftaruser()
    {
        $data = [
            'title' => 'Daftar User',
            'daftaruser' => $this->userModel->getUser()
        ];
        return view('admin/user', $data);
    }

    public function daftarkamar()
    {
        $data = [
            'title' => 'Daftar User',
            'daftarkamar' => $this->kamarModel->getKamar()
        ];
        return view('kamar/index', $data);
    }

    public function detail($nama)
    {
        $kamar = $this->kamarModel->getKamar($nama);

        //Jika kamar tidak ada di tabel
        if (empty($kamar)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Kamar ' . $nama . ' Tidak ditemukan');
        }

        $data = [
            'title' => 'Detail kamar',
            'kamar' => $kamar
        ];

        return view('kamar/detail', $data);
    }

    public function edit($nama)
    {
        $data = [
            'title' => 'Form Ubah Data Kamar',
            'validation' => \Config\Services::validation(),
            'kamar' => $this->kamarModel->getKamar($nama)
        ];
        return view('kamar/edit', $data);
    }

    public function tambahkamar()
    {

        $data = [
            'title' => 'Form Tambah Kamar',
        ];
        return view('kamar/tambah', $data);
    }

    public function update($id)
    {


        //Cek judul, kalau judul dirubah maka cek is_unique, kalau judul tidak diubah maka tak perlu cek is_unique
        // $komik = $this->komikModel->find($id); // Ambil data komik berdasarkan ID

        // // Rules
        // $rule_judul = 'required';
        // if ($komik['judul'] != $this->request->getVar('judul')) {
        //     $rule_judul .= '|is_unique[komik.judul]';
        // }
        //Validasi Input
        if (!$this->validate([
            'Nama' => [
                'rules' => 'required|is_unique[kamar.nama,id,' . $id . ']',
                'errors' => [
                    'required' => '{field} kamar harus diisi.',
                    'is_unique' => '{field} kamar sudah tersedia.'
                ]
            ],
            'Harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} kamar harus diisi.',
                ]
            ],
            'Luas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} kamar harus diisi.',
                ]
            ],
            'Deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} kamar harus diisi.',
                ]
            ],
            'Gambar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} kamar harus diisi.',
                ]
            ],

        ])) {
            $validation = \Config\Services::validation()->listErrors();
            return redirect()->to('admin/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }


        $this->kamarModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('Nama'),
            'harga' => $this->request->getVar('Harga'),
            'luas' => $this->request->getVar('Luas'),
            'deskripsi' => $this->request->getVar('Deskripsi'),
            'gambar' => $this->request->getVar('Gambar'),
        ]);


        session()->setFlashdata('pesan', 'Data berhasill diubah');
        //setelah berhasil kita kembaliin ke halaman index lagi
        return redirect()->to('admin/daftarkamar')->with('success', 'Data kamar berhasil diubah');;
    }

    public function save()
    {

        $sampulFile = $this->request->getFile('Gambar');        //Validasi Input
        if (!$this->validate([
            'Nama' => [
                'rules' => 'required|is_unique[kamar.nama]',
                'errors' => [
                    'required' => '{field} kamar harus diisi',
                    'is_unique' => '{field} kamar sudah tersedia.'
                ]
            ],
            'Harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} kamar harus diisi',
                ]
            ],
            'Luas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} kamar harus diisi',
                ]
            ],
            'Deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} kamar harus diisi',
                ]
            ],
            'Gambar' => [
                'rules' => 'uploaded[Gambar]',
                'errors' => [
                    'uploaded' => '{field} kamar harus diunggah.',
                ]
            ],

        ])) {
            $validation = \Config\Services::validation()->listErrors();
            return redirect()->to('Admin/tambahkamar')->withInput()->with('validation', $validation);
            //Save ngirim semua input, terus kirim validationnya, teru sdiambil di fucntion create Kita bakal redirect ke create page
        }
        //dd($this->request->getVar());//Ambil semuanya, kalo mau satu, masukin parameternya di dalem tand kurunS


        if ($sampulFile->isValid() && !$sampulFile->hasMoved()) {
            $newSampul = $sampulFile->getRandomName();
            $sampulFile->move('img', $newSampul); // Move to the 'public/img' directory

            $this->kamarModel->save([
                'nama' => $this->request->getVar('Nama'),
                'harga' => $this->request->getVar('Harga'),
                'luas' => $this->request->getVar('Luas'),
                'deskripsi' => $this->request->getVar('Deskripsi'),
                'gambar' => $newSampul,
            ]);
        }

        session()->setFlashdata('pesan', 'Data berhasill ditambahkan');
        //setelah berhasil kita kembaliin ke halaman index lagi
        return redirect()->to('Admin/daftarkamar');
    }

    public function delete($id)
    {
        $this->kamarModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasill dihapus');
        return redirect()->to(base_url('admin/listbarang'));
    }
}
