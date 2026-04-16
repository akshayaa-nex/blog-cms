<?php $this->extend('layout'); ?>

<?php $this->section('content'); ?>

<div class="container mt-5">

    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Blog Posts</h1>
        </div>

        <div class="col-md-4 text-end">
            <?php if (session()->get('logged_in')): ?>
                <a href="/posts/create" class="btn btn-primary">Create New Post</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= esc(session()->getFlashdata('success')); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row d-flex align-items-stretch">

        <?php if (empty($posts)): ?>

            <div class="col-md-12">
                <p class="text-muted">
                    No posts yet. 
                    <?php if (session()->get('logged_in')): ?>
                        <a href="/posts/create">Create one now</a>
                    <?php endif; ?>
                </p>
            </div>

        <?php else: ?>

            <?php foreach ($posts as $post): ?>

               <div class="col-md-6 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body">

                            <h5 class="card-title">
                                <?= esc($post['title'] ?? '') ?>
                            </h5>

                            <p class="card-text">
                                <?= substr(esc((string)($post['content'] ?? '')), 0, 100) ?>...
                            </p>

                            <small class="text-muted">
                                Posted by <?= esc($post['author'] ?? 'Unknown') ?> on 
                                <?= !empty($post['created_at']) 
                                    ? date('M d, Y', strtotime((string)$post['created_at'])) 
                                    : 'N/A'; ?>
                            </small>

                            <br><br>

                            <a href="/posts/<?= esc($post['id']) ?>/detail" class="btn btn-sm btn-info">
                                Read More
                            </a>

                            <?php if (session()->get('user_id') == ($post['user_id'] ?? null)): ?>

                                <a href="/posts/edit/<?= esc($post['id']) ?>" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="/posts/delete/<?= esc($post['id']) ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure?')">
                                    Delete
                                </a>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</div>

<?php $this->endSection(); ?>