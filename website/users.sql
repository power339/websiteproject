-- Create the database
CREATE DATABASE auth_system;
USE auth_system;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a sample user (password is "password123")
INSERT INTO users (name, email, password) VALUES (
    'Test User',
    'test@example.com',
    '$2y$10$9lJ7RZddj1HgZ3jLrC8Fduqlm5u4cXq9lfBZU3JMW1QUyLOjKeAC2'
);

CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  link TEXT NOT NULL,
  posted_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  filename VARCHAR(255),
  filepath VARCHAR(255),
  size VARCHAR(50),
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

