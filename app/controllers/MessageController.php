<?php

declare(strict_types=1);

class MessageController
{
    private Message $messageModel;

    public function __construct()
    {
        $this->messageModel = new Message();
    }

    public function store(): void
    {
        $data = [
            'sender_name' => trim($_POST['sender_name'] ?? ''),
            'sender_email' => trim($_POST['sender_email'] ?? ''),
            'subject' => trim($_POST['subject'] ?? ''),
            'message_body' => trim($_POST['message_body'] ?? ''),
            'user_id' => $_SESSION['user']['id'] ?? null,
        ];

        $errors = [];
        if ($data['sender_name'] === '') $errors[] = 'Name is required.';
        if (!filter_var($data['sender_email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
        if ($data['subject'] === '' || $data['message_body'] === '') $errors[] = 'Subject and message are required.';

        if ($errors) {
            (new PageController())->contact($errors, $data);
            return;
        }

        $this->messageModel->create($data);
        $_SESSION['flash'] = 'Message sent successfully.';
        View::redirect('contact');
    }

    public function index(): void
    {
        if (!isset($_SESSION['user'])) {
            View::redirect('login');
        }

        $messages = $this->messageModel->allLatestFirst();
        View::render('messages/index', ['messages' => $messages]);
    }
}
