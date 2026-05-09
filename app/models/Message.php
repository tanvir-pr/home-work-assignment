<?php

declare(strict_types=1);

class Message
{
    public function create(array $data): bool
    {
        $sql = 'INSERT INTO messages (sender_name, sender_email, subject, message_body, user_id, created_at) VALUES (:sender_name, :sender_email, :subject, :message_body, :user_id, NOW())';
        $stmt = Database::getConnection()->prepare($sql);

        return $stmt->execute([
            'sender_name' => $data['sender_name'],
            'sender_email' => $data['sender_email'],
            'subject' => $data['subject'],
            'message_body' => $data['message_body'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function allLatestFirst(): array
    {
        $sql = 'SELECT m.*, u.family_name, u.surname FROM messages m LEFT JOIN users u ON u.id = m.user_id ORDER BY m.created_at DESC';
        $stmt = Database::getConnection()->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
