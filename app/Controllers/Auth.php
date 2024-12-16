<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
        helper(['form', 'url']);
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
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid input data'
            ]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        // Add debug logging
        log_message('debug', 'Login attempt - Email: ' . $email);
        log_message('debug', 'User found: ' . ($user ? 'Yes' : 'No'));

        if ($user) {
            log_message('debug', 'Password verification: ' . (password_verify($password, $user['password']) ? 'Success' : 'Failed'));
        }

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
            'password' => $this->request->getPost('password'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        try {
            if ($this->userModel->insert($data)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Registration successful']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Registration failed: ' . $e->getMessage()]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Registration failed']);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }

    public function testConnection()
    {
        try {
            $user = $this->userModel->first();
            var_dump($user);
            echo "Database connection successful";
        } catch (\Exception $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
}
