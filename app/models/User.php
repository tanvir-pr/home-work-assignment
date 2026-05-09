<?php

declare(strict_types=1);

class User
{
    public function create(array $data): bool
    {
        $sql = 'INSERT INTO users (family_name, surname, login_name, password_hash) VALUES (:family_name, :surname, :login_name, :password_hash)';
        $stmt = Database::getConnection()->prepare($sql);

        return $stmt->execute([
            'family_name' => $data['family_name'],
            'surname' => $data['surname'],
            'login_name' => $data['login_name'],
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
    }

    public function findByLoginName(string $loginName): ?array
    {
        $stmt = Database::getConnection()->prepare('SELECT * FROM users WHERE login_name = :login_name LIMIT 1');
        $stmt->execute(['login_name' => $loginName]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }
}
