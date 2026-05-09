<?php

declare(strict_types=1);

class GalleryController
{
    private Gallery $galleryModel;

    public function __construct()
    {
        $this->galleryModel = new Gallery();
    }

    public function index(): void
    {
        $images = $this->galleryModel->all();
        View::render('gallery/index', ['images' => $images]);
    }

    public function upload(): void
    {
        if (!isset($_SESSION['user'])) {
            View::redirect('login');
        }

        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['flash'] = 'Upload failed.';
            View::redirect('images');
        }

        $file = $_FILES['image'];
        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

        if (!in_array($file['type'], $allowed, true) || $file['size'] > MAX_UPLOAD_SIZE) {
            $_SESSION['flash'] = 'Only JPG, PNG, WEBP, GIF up to 2MB are allowed.';
            View::redirect('images');
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $name = uniqid('img_', true) . '.' . strtolower($ext);
        $target = UPLOAD_DIR . $name;

        if (!move_uploaded_file($file['tmp_name'], $target)) {
            $_SESSION['flash'] = 'Could not save image.';
            View::redirect('images');
        }

        $this->galleryModel->create($name, (int)$_SESSION['user']['id']);
        $_SESSION['flash'] = 'Image uploaded successfully.';
        View::redirect('images');
    }
}
