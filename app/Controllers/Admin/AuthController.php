<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('admin/auth');
    }

    public function authenticate()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('errors', $validation->getErrors())->withInput();
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Pastikan email dan password adalah string sebelum melanjutkan
        if (!is_string($email) || !is_string($password)) {
            return redirect()->back()->with('errors', ['Invalid credentials'])->withInput();
        }

        // Authentication logic here (example with a User model)
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] !== 'admin') {  // Cek peran pengguna
                return redirect()->back()->with('errors', ['Access denied'])->withInput();
            }

            session()->set([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'user_role' => $user['role'],  // Simpan peran pengguna dalam sesi
                'is_logged_in' => true,
            ]);

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('errors', ['Invalid credentials'])->withInput();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->route('admin.login');
    }
}


