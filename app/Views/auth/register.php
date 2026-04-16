<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h2>Register</h2>

<?php if (session()->get('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->get('errors') as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="/save">
    <?= csrf_field(); ?>

    <input type="text" name="name" placeholder="Enter Name" required>
    <br><br>

    <input type="email" name="email" placeholder="Enter Email" required>
    <br><br>

    <input type="password" name="password" placeholder="Enter Password" required>
    <br><br>

    <input type="password" name="password_confirm" placeholder="Confirm Password" required>
    <br><br>

    <button class="btn btn-primary">Register</button>
</form>

<p>Already have account? <a href="/login">Login</a></p>

<?= $this->endSection() ?>