<?php

declare(strict_types=1);

class Pizza
{
    public function all(): array
    {
        $sql = 'SELECT p.*, c.price AS category_price
                FROM pizzas p
                LEFT JOIN pizza_categories c ON c.cname = p.category_name
                ORDER BY p.id DESC';
        $stmt = Database::getConnection()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $sql = 'INSERT INTO pizzas (pizza_name, category_name, vegetarian, created_at)
                VALUES (:pizza_name, :category_name, :vegetarian, NOW())';
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $sql = 'UPDATE pizzas
                SET pizza_name = :pizza_name, category_name = :category_name, vegetarian = :vegetarian
                WHERE id = :id';
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = Database::getConnection()->prepare('DELETE FROM pizzas WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function find(int $id): ?array
    {
        $stmt = Database::getConnection()->prepare('SELECT * FROM pizzas WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
}
