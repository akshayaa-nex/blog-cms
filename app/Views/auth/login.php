<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h2>Login</h2>


<?php if (session()->get('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->get('errors') as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<form method="post" action="/check">
    
    <?= csrf_field(); ?>

    <input type="email" name="email" placeholder="Enter Email" required>
    <br><br>

    <input type="password" name="password" placeholder="Enter Password" required>
    <br><br>

    <button class="btn btn-primary">Login</button>
</form>

<p>Don't have account? <a href="/register">Register</a></p>

<?= $this->endSection() ?>