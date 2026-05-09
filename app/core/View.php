<?php

declare(strict_types=1);

class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/' . $view . '.php';
        require __DIR__ . '/../views/layout/footer.php';
    }

    public static function redirect(string $route): void
    {
        header('Location: ' . BASE_URL . '?route=' . $route);
        exit;
    }
}
