<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index(): string
    {
        return view('auth/login');
    }

    public function registerAdminForm()
    {
        return view('auth/registerAdmin');
    }

    public function registerForm()
    {
        return view('auth/register');
    }

    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Username atau password salah!');
        }

        session()->set([
            'id'        => $user['id'],
            'name'      => $user['name'],
            'username'  => $user['username'],
            'email'     => $user['email'], // penting agar email bisa tampil
            'role'      => $user['role'],
            'logged_in' => true,
        ]);

        $redirectUrl = match ($user['role']) {
            'superadmin' => 'superadmin/dashboard',
            'admin'      => 'admin/dashboard',
            default      => 'pengguna/berandaLogin',
        };

        // TAMBAHKAN INI untuk notifikasi SweetAlert2
        session()->setFlashdata('login_success', true);

        return redirect()->to(base_url($redirectUrl))->with('success', 'Login berhasil!');
    }

    public function registerAdminProcess()
    {
        $rules = [
            'name'             => 'required|min_length[3]',
            'username'         => 'required|min_length[3]|is_unique[users.username]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'matches[password]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/registerAdmin', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new UserModel();
        $userModel->save([
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'admin',
        ]);

        return redirect()->to(base_url('login'))->with('success', 'Registrasi admin berhasil, silakan login.');
    }

    public function registerProcess()
    {
        $rules = [
            'name'             => 'required|min_length[3]',
            'username'         => 'required|min_length[3]|is_unique[users.username]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'matches[password]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new UserModel();
        $userModel->save([
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'pengguna',
        ]);

        return redirect()->to(base_url('login'))->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Logout berhasil!');
    }
}
