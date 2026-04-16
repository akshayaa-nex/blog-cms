<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <h1><?= esc($post['title'] ?? '') ?></h1>

            <p class="text-muted">
                Posted by <?= esc($post['author'] ?? 'Unknown') ?> on 
                <?= !empty($post['created_at']) 
                    ? date('F d, Y', strtotime((string)($post['created_at'] ?? ''))) 
                    : 'N/A' ?>
            </p>

            <hr>

            <div>
                <?= nl2br(esc((string)($post['content'] ?? ''))) ?>
            </div>

            <br>

            <a href="/posts" class="btn btn-secondary">Back</a>

        </div>
    </div>
</div>

<?= $this->endSection() ?>