<?php

declare(strict_types=1);

class PageController
{
    public function home(): void
    {
        View::render('pages/home');
    }

    public function contact(array $errors = [], array $old = []): void
    {
        View::render('pages/contact', ['errors' => $errors, 'old' => $old]);
    }
}
