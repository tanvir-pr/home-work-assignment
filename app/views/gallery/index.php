<section>
    <h2>Images Gallery</h2>
    <?php if (isset($_SESSION['user'])): ?>
        <form action="<?= BASE_URL ?>?route=upload-image" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="input-group"><input type="file" class="form-control" name="image" accept="image/*" required><button class="btn btn-primary">Upload image</button></div>
        </form>
    <?php else: ?>
        <p class="alert alert-warning">You must login to upload images.</p>
    <?php endif; ?>
    <div class="row g-3">
        <?php foreach ($images as $image): ?>
            <div class="col-sm-6 col-lg-3"><img src="assets/uploads/<?= htmlspecialchars($image['file_name']) ?>" class="img-fluid rounded border" alt="Gallery image"></div>
        <?php endforeach; ?>
    </div>
</section>
