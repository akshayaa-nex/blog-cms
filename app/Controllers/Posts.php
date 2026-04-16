<?php

namespace App\Controllers;

use App\Models\PostModel;

class Posts extends BaseController
{
    public function index()
    {
        $model = new PostModel();

        $data['posts'] = $model
            ->select('posts.*, users.name as author')
            ->join('users', 'users.id = posts.user_id')
            ->findAll();

        return view('posts/index', $data);
    }

    public function detail($id)
    {
        $model = new PostModel();

        $data['post'] = $model
            ->select('posts.*, users.name as author')
            ->join('users', 'users.id = posts.user_id')
            ->where('posts.id', $id)
            ->first();

        return view('posts/detail', $data);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }

        return view('posts/create');
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (!$this->validate([
            'title' => 'required|min_length[3]',
            'content' => 'required|min_length[10]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new PostModel();

        $model->save([
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'user_id' => session()->get('user_id')
        ]);

        return redirect()->to('/posts')->with('success', 'Post created');
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $model = new PostModel();
        $data['post'] = $model->find($id);

        return view('posts/edit', $data);
    }

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (!$this->validate([
            'title' => 'required|min_length[3]',
            'content' => 'required|min_length[10]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new PostModel();

        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ]);

        return redirect()->to('/posts')->with('success', 'Post updated');
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $model = new PostModel();
        $model->delete($id);

        return redirect()->to('/posts')->with('success', 'Post deleted');
    }
}