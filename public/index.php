<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/View.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/models/Message.php';
require_once __DIR__ . '/../app/models/Gallery.php';
require_once __DIR__ . '/../app/models/Pizza.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/PageController.php';
require_once __DIR__ . '/../app/controllers/MessageController.php';
require_once __DIR__ . '/../app/controllers/GalleryController.php';
require_once __DIR__ . '/../app/controllers/CrudController.php';

$authController = new AuthController();
$pageController = new PageController();
$messageController = new MessageController();
$galleryController = new GalleryController();
$crudController = new CrudController();

$route = $_GET['route'] ?? 'home';
$method = $_SERVER['REQUEST_METHOD'];

switch ($route) {
    case 'home':
        $pageController->home();
        break;
    case 'contact':
        if ($method === 'POST') {
            $messageController->store();
        } else {
            $pageController->contact();
        }
        break;
    case 'messages':
        $messageController->index();
        break;
    case 'login':
        if ($method === 'POST') {
            $authController->login();
        } else {
            $authController->showLogin();
        }
        break;
    case 'register':
        if ($method === 'POST') {
            $authController->register();
        } else {
            $authController->showLogin();
        }
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'images':
        $galleryController->index();
        break;
    case 'upload-image':
        $galleryController->upload();
        break;
    case 'crud':
        $crudController->index();
        break;
    case 'crud-create':
        $crudController->create();
        break;
    case 'crud-edit':
        $crudController->edit();
        break;
    case 'crud-delete':
        $crudController->delete();
        break;
    default:
        http_response_code(404);
        echo '404 - Page not found';
        break;
}
