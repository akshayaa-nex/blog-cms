<?php

namespace App\Controllers\API;

use App\Models\PostModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class PostsAPI extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\PostModel';
    protected $format = 'json';

    public function index()
    {
        $posts = $this->model->findAll();
        return $this->respond($posts, 200);
    }

    public function show($id = null)
    {
        $post = $this->model->find($id);
        
        if (!$post) {
            return $this->failNotFound('Post not found');
        }

        return $this->respond($post, 200);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[10]',
            'user_id' => 'required|numeric',
        ])) {
            return $this->fail($this->validator->getErrors(), 400);
        }

        $post = [
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'content' => $data['content'],
        ];

        if ($this->model->save($post)) {
            $id = $this->model->getInsertID();
            return $this->respondCreated(['id' => $id, 'message' => 'Post created successfully']);
        }

        return $this->fail('Failed to create post', 500);
    }

    public function update($id = null)
    {
        $post = $this->model->find($id);
        
        if (!$post) {
            return $this->failNotFound('Post not found');
        }

        $data = $this->request->getJSON(true);

        if (!$this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[10]',
        ])) {
            return $this->fail($this->validator->getErrors(), 400);
        }

        $update = [
            'title' => $data['title'],
            'content' => $data['content'],
        ];

        if ($this->model->update($id, $update)) {
            return $this->respond(['message' => 'Post updated successfully']);
        }

        return $this->fail('Failed to update post', 500);
    }

    public function delete($id = null)
    {
        $post = $this->model->find($id);
        
        if (!$post) {
            return $this->failNotFound('Post not found');
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted(['message' => 'Post deleted successfully']);
        }

        return $this->fail('Failed to delete post', 500);
    }
}
