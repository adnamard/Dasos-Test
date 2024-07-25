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
            'title' => 'Halaman Login'
        ];
        return view('autentikasi/login', $data);
    }

    public function halamanregister()
    {
        $data = [
            'title' => 'Halaman Register'
        ];
        return view('autentikasi/register', $data);
    }

    public function register()
    {
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
                'Password' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'min_length' => '{field} minimal tiga karakter.'
                    ]
                ],
            ]
        )) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
                'redirect' => base_url('autentikasi/halamanregister') // Adjusted URL here
            ]);
        }
        $password = $this->request->getPost('Password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            'username' => $this->request->getPost('Username'),
            'email' => $this->request->getPost('Email'),
            'password' => $hashedPassword,
        ];
        $this->userModel->insert($data);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Selamat anda berhasil registrasi, silakan login.',
            'redirect' => base_url('autentikasi/halamanlogin')
        ]);
    }


    public function login()
    {
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
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
                'redirect' => base_url('autentikasi/halamanlogin') // Adjusted URL here
            ]);
        }

        // Ambil data dari form
        $username = $this->request->getPost('Username');
        $password = $this->request->getPost('Password');

        $user = $this->userModel->where('username', $username)->first();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $userData = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'isLoggedIn' => true
                ];
                session()->set('userData', $userData);
            } else {
                session()->setFlashdata('pesan', 'Password tidak sesuai.');
                return redirect()->to('autentikasi/halamanlogin')->withInput();
            }
        } else {
            session()->setFlashdata('pesan', 'Username tidak ditemukan.');
            return redirect()->to('autentikasi/halamanlogin')->withInput();
        }
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Selamat datang, ' . $user['username'] . '. Anda berhasil login.',
            'redirect' => base_url('/')
        ]);
    }
}
