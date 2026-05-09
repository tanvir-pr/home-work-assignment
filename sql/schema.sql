CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    family_name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    login_name VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_name VARCHAR(150) NOT NULL,
    sender_email VARCHAR(150) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message_body TEXT NOT NULL,
    user_id INT NULL,
    created_at DATETIME NOT NULL,
    CONSTRAINT fk_messages_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS gallery_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    created_at DATETIME NOT NULL,
    CONSTRAINT fk_gallery_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS pizza_categories (
    cname VARCHAR(50) PRIMARY KEY,
    price INT NOT NULL
);

CREATE TABLE IF NOT EXISTS pizzas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pizza_name VARCHAR(150) NOT NULL UNIQUE,
    category_name VARCHAR(50) NOT NULL,
    vegetarian TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL,
    CONSTRAINT fk_pizzas_categories FOREIGN KEY (category_name) REFERENCES pizza_categories(cname)
);

CREATE TABLE IF NOT EXISTS pizza_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pizza_name VARCHAR(150) NOT NULL,
    amount INT NOT NULL,
    taken DATETIME NOT NULL,
    dispatched DATETIME NOT NULL
);
