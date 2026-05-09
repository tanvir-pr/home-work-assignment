<div class="row g-4">
    <div class="col-md-6">
        <h2>Login</h2>
        <?php if (!empty($errors)): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
        <form action="<?= BASE_URL ?>?route=login" method="post">
            <div class="mb-3"><label class="form-label">Login name</label><input class="form-control" name="login_name" value="<?= htmlspecialchars($old['login_name'] ?? '') ?>"></div>
            <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password"></div>
            <button class="btn btn-success">Login</button>
        </form>
    </div>
    <div class="col-md-6">
        <h2>Register</h2>
        <form action="<?= BASE_URL ?>?route=register" method="post">
            <div class="mb-3"><label class="form-label">Family name</label><input class="form-control" name="family_name" value="<?= htmlspecialchars($old['family_name'] ?? '') ?>"></div>
            <div class="mb-3"><label class="form-label">Surname</label><input class="form-control" name="surname" value="<?= htmlspecialchars($old['surname'] ?? '') ?>"></div>
            <div class="mb-3"><label class="form-label">Login name</label><input class="form-control" name="login_name" value="<?= htmlspecialchars($old['login_name'] ?? '') ?>"></div>
            <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password"></div>
            <button class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
