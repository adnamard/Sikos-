<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $helpers = ['form'];

    protected $session;


    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
    }

    public function halamanlogin()
    {
        $data = [
            'title' => 'Sikost ^_^ - Halaman Login'
        ];
        return view('autentikasi/login', $data);
    }

    public function halamanregister()
    {
        $data = [
            'title' => 'Sikost ^_^ - Halaman Login'
        ];
        return view('autentikasi/register', $data);
    }

    public function register()
    { //Validasi data yang sudah ditangkap
        if (!$this->validate(
            [
                'Username' => [
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'is_unique' => '{field} tidak tersedia.',
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'Email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'Telepon' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'min_length' => '{field} minimal delapan karakter.'
                    ]
                ],
                'Alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'Password' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'min_length' => '{field} minimal tiga karakter.'
                    ]
                ],
            ]
        )) {
            //Jika validasi gagal
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesangagal', $validation->listErrors());
            return redirect()->to('auth/halamanregister')->withInput()->with('validation', $validation);
        }
        //Jika validasi berhasil
        //Memutuskan nanti data apa saja yang disimpan di tabel user
        $password = $this->request->getPost('Password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            'username' => $this->request->getPost('Username'),
            'email' => $this->request->getPost('Email'),
            'telepon' => $this->request->getPost('Telepon'),
            'alamat' => $this->request->getPost('Alamat'),
            'password' => $hashedPassword,
            'role' => 1,
        ];
        $this->userModel->insert($data);
        session()->setFlashdata('pesansukses', 'Selamat anda berhasil registrasi, silakan login.');
        return redirect()->to('auth/halamanlogin');
    }

    public function login()
    {
        // Lakukan validasi untuk login
        if (!$this->validate(
            [
                'Username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]

                ],
                'Password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
            ]
        )) {
            //Jika validasi gagal
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan', $validation->listErrors());
            return redirect()->to('autentikasi/halamanlogin')->withInput()->with('validation', $validation);
        }

        // Ambil data dari form
        $username = $this->request->getPost('Username');
        $password = $this->request->getPost('Password');

        // Cari pengguna berdasarkan username
        $user = $this->userModel->where('username', $username)->first();

        // Periksa apakah pengguna ditemukan dan cocok dengan password
        if ($user) {
            // Jika pengguna ditemukan, verifikasi password
            if (password_verify($password, $user['password'])) {
                // Password cocok, autentikasi berhasil, set session atau tindakan lain yang sesuai

                // Contoh: Set session pengguna
                $userData = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'telepon' => $user['telepon'],
                    'alamat' => $user['alamat'],
                    'role' => $user['role'],
                    // Tambahkan data lain jika diperlukan
                ];
                session()->set('userData', $userData);
                if ($userData['role'] == 0) {
                    return redirect()->to('/');
                } elseif ($userData['role'] == 1) {
                    return redirect()->to('/admin');
                }
            } else {
                // Password tidak cocok
                session()->setFlashdata('pesan', 'Password tidak sesuai.');
                return redirect()->to('autentikasi/halamanlogin')->withInput();
            }
        } else {
            // Pengguna tidak ditemukan
            session()->setFlashdata('pesan', 'Username tidak ditemukan.');
            return redirect()->to('autentikasi/halamanlogin')->withInput();
        }
        // Redirect ke halaman dashboard atau halaman setelah login
        return redirect()->to('/admin'); // Ubah 'Dashboard' sesuai halaman setelah login
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        session()->setFlashdata('pesan', 'Success for logout, comeback later!');
        return redirect()->to('/');
    }
}
