<?php

declare(strict_types=1);

class AuthController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLogin(array $errors = [], array $old = []): void
    {
        View::render('auth/login', ['errors' => $errors, 'old' => $old]);
    }

    public function register(): void
    {
        $familyName = trim($_POST['family_name'] ?? '');
        $surname = trim($_POST['surname'] ?? '');
        $loginName = trim($_POST['login_name'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];
        if ($familyName === '' || $surname === '' || $loginName === '' || $password === '') {
            $errors[] = 'All registration fields are required.';
        }

        if ($this->userModel->findByLoginName($loginName)) {
            $errors[] = 'Login name is already taken.';
        }

        if ($errors) {
            $this->showLogin($errors, ['family_name' => $familyName, 'surname' => $surname, 'login_name' => $loginName]);
            return;
        }

        $this->userModel->create([
            'family_name' => $familyName,
            'surname' => $surname,
            'login_name' => $loginName,
            'password' => $password,
        ]);

        $_SESSION['flash'] = 'Registration successful. Please login.';
        View::redirect('login');
    }

    public function login(): void
    {
        $loginName = trim($_POST['login_name'] ?? '');
        $password = $_POST['password'] ?? '';
        $user = $this->userModel->findByLoginName($loginName);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $this->showLogin(['Invalid login credentials.'], ['login_name' => $loginName]);
            return;
        }

        $_SESSION['user'] = [
            'id' => (int)$user['id'],
            'family_name' => $user['family_name'],
            'surname' => $user['surname'],
            'login_name' => $user['login_name'],
        ];

        View::redirect('home');
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        View::redirect('home');
    }
}
