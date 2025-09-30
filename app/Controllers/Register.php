<?php

namespace App\Controllers;
use App\Models\UserModel;

class Register extends BaseController
{
    public function index(): string
    {
        return view('register');
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to(route_to('register'))->withInput()->with('errors', $validation->getErrors());
        }

        $users = new UserModel();
        
        $data = [
            'name' => $this->request->getVar('name'),
            'phone_number' => $this->request->getVar('phone_number'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => 'member'
        ];
        
        $users->save($data);
        
        return redirect()->to(route_to('login'));
    }
}
