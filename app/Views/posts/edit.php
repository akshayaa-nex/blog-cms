<?php $this->extend('layout'); ?>

<?php $this->section('content'); ?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1>Edit Post</h1>
        
        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/posts/update/<?= $post['id']; ?>" method="post">
            <?= csrf_field(); ?>
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= esc($post['title']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="8" required><?= esc($post['content']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
            <a href="/posts" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php $this->endSection(); ?>
