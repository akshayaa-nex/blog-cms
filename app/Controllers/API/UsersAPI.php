<?php

namespace App\Controllers\API;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class UsersAPI extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function index()
    {
        $users = $this->model->findAll();
        // Don't return passwords
        foreach ($users as &$user) {
            unset($user['password']);
        }
        return $this->respond($users, 200);
    }

    public function show($id = null)
    {
        $user = $this->model->find($id);
        
        if (!$user) {
            return $this->failNotFound('User not found');
        }

        // Don't return password
        unset($user['password']);
        return $this->respond($user, 200);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->validate([
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ])) {
            return $this->fail($this->validator->getErrors(), 400);
        }

        $user = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ];

        if ($this->model->save($user)) {
            $id = $this->model->getInsertID();
            return $this->respondCreated(['id' => $id, 'message' => 'User created successfully']);
        }

        return $this->fail('Failed to create user', 500);
    }

    public function update($id = null)
    {
        $user = $this->model->find($id);
        
        if (!$user) {
            return $this->failNotFound('User not found');
        }

        $data = $this->request->getJSON(true);

        if (!$this->validate([
            'name' => 'permit_empty|min_length[2]|max_length[100]',
            'email' => 'permit_empty|valid_email',
        ])) {
            return $this->fail($this->validator->getErrors(), 400);
        }

        $update = [];
        if (isset($data['name'])) {
            $update['name'] = $data['name'];
        }
        if (isset($data['email'])) {
            $update['email'] = $data['email'];
        }
        if (isset($data['password'])) {
            $update['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        if ($this->model->update($id, $update)) {
            return $this->respond(['message' => 'User updated successfully']);
        }

        return $this->fail('Failed to update user', 500);
    }

    public function delete($id = null)
    {
        $user = $this->model->find($id);
        
        if (!$user) {
            return $this->failNotFound('User not found');
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted(['message' => 'User deleted successfully']);
        }

        return $this->fail('Failed to delete user', 500);
    }
}
