<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza House Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark app-navbar shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>?route=home">Pizza House</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>?route=home">Mainpage</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>?route=images">Images</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>?route=contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>?route=crud">CRUD</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>?route=messages">Messages</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>?route=logout">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>?route=login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<header class="app-hero text-white py-4 mb-4 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
        <h1 class="h3 m-0">Pizza House Web App</h1>
        <?php if (isset($_SESSION['user'])): ?>
            <p class="m-0 badge rounded-pill text-bg-light px-3 py-2">Logged-in: <?= htmlspecialchars($_SESSION['user']['family_name']) ?> <?= htmlspecialchars($_SESSION['user']['surname']) ?> (<?= htmlspecialchars($_SESSION['user']['login_name']) ?>)</p>
        <?php endif; ?>
    </div>
</header>
<main class="container pb-5">
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-info"><?= htmlspecialchars($_SESSION['flash']) ?></div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
