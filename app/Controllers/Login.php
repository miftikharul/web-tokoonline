<?php

namespace App\Controllers;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function authenticate()
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        $users = new UserModel();
        
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $user = $users->where('email', $email)->first();
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                session()->set([
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'isLoggedIn' => true
                ]);
                if ($user['role'] == 'member') {
                    return redirect()->to('home');
                } else {
                    return redirect()->back()->with('error', 'You do not have permission to access this page');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid Password');
            }
        } else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }
    

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
