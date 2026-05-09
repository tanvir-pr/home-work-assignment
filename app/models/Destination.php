<?php

declare(strict_types=1);

class Destination
{
    public function all(): array
    {
        $stmt = Database::getConnection()->query('SELECT * FROM destinations ORDER BY id DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $sql = 'INSERT INTO destinations (name, country, category, description, created_at) VALUES (:name, :country, :category, :description, NOW())';
        $stmt = Database::getConnection()->prepare($sql);

        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $sql = 'UPDATE destinations SET name = :name, country = :country, category = :category, description = :description WHERE id = :id';
        $stmt = Database::getConnection()->prepare($sql);

        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = Database::getConnection()->prepare('DELETE FROM destinations WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function find(int $id): ?array
    {
        $stmt = Database::getConnection()->prepare('SELECT * FROM destinations WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }
}
