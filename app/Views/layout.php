<!DOCTYPE html>
<html>
<head>
    <title>Blog CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="/">Curious Blog</a>

        <div class="d-flex">

            <?php if (session()->get('logged_in')): ?>

                <a href="/posts" class="nav-link text-white">Posts</a>
                <a href="/logout" class="nav-link text-white">Logout</a>

            <?php else: ?>

                <a href="/login" class="nav-link text-white">Login</a>
                <a href="/register" class="nav-link text-white">Register</a>

            <?php endif; ?>

        </div>
    </div>
</nav>

<div class="container mt-4">
    <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>