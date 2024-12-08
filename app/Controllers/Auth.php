<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $session;

    public function __construct()
    {
        // Start session
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        // Redirect to dashboard if already logged in
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function register()
    {
        // Redirect to dashboard if already logged in
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }

    public function processLogin()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $this->session->set([
                'user_id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'isLoggedIn' => true
            ]);
            
            return $this->response->setJSON(['status' => 'success', 'message' => 'Login successful']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid email or password']);
    }

    public function processRegister()
    {
        $userModel = new UserModel();
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => implode('<br>', $this->validator->getErrors())
            ]);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        if ($userModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Registration successful']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Registration failed']);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
} 