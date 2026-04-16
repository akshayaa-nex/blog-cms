<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function save()
    {
        $model = new UserModel();

        // Validate input
        if (!$this->validate([
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $model->save($data);

        return redirect()->to('/')->with('success', 'Registration successful! Please login with your credentials.');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function check()
    {
        // Validate input
        if (!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $user = $model->where('email', $this->request->getPost('email'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set([
            'user_id' => $user['id'],
            'user_email' => $user['email'],
            'logged_in' => true
        ]);
            return redirect()->to('/posts')->with('success', 'Welcome back!');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
?>