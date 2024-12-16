CREATE DATABASE database;

CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    reset_token_hash VARCHAR(64) DEFAULT NULL,
    reset_token_expires_at DATETIME DEFAULT NULL,
    profile_image VARCHAR(255) DEFAULT 'uploads/default.jpg',
    UNIQUE (reset_token_hash), -- Chỉ mục UNIQUE cho reset_token_hash
    INDEX (email)
);

CREATE TABLE addresses (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) DEFAULT NULL,
    name VARCHAR(50) DEFAULT NULL,
    phone VARCHAR(15) DEFAULT NULL,
    address_type ENUM('Home', 'Office') DEFAULT NULL,
    province VARCHAR(50) DEFAULT NULL,
    district VARCHAR(50) DEFAULT NULL,
    ward VARCHAR(50) DEFAULT NULL,
    specific_address VARCHAR(255) DEFAULT NULL,
    INDEX (user_id),
    CONSTRAINT fk_user_address FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);