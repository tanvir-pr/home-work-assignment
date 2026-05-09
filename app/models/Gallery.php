<?php

declare(strict_types=1);

class Gallery
{
    public function create(string $fileName, int $userId): bool
    {
        $stmt = Database::getConnection()->prepare('INSERT INTO gallery_images (file_name, user_id, created_at) VALUES (:file_name, :user_id, NOW())');

        return $stmt->execute([
            'file_name' => $fileName,
            'user_id' => $userId,
        ]);
    }

    public function all(): array
    {
        $stmt = Database::getConnection()->query('SELECT * FROM gallery_images ORDER BY created_at DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
