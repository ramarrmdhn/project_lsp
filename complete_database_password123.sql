-- Script lengkap untuk database concert ticket system dengan password password123
-- Jalankan script ini di phpMyAdmin

-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS concert_ticket_system;
USE concert_ticket_system;

-- Hapus tabel jika sudah ada
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS tickets;
DROP TABLE IF EXISTS concerts;
DROP TABLE IF EXISTS users;

-- Buat tabel users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') DEFAULT 'customer',
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Buat tabel concerts
CREATE TABLE concerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    artist VARCHAR(100) NOT NULL,
    venue VARCHAR(200) NOT NULL,
    concert_date DATETIME NOT NULL,
    ticket_price DECIMAL(10,2) NOT NULL,
    total_tickets INT NOT NULL,
    available_tickets INT NOT NULL,
    image VARCHAR(255),
    status ENUM('upcoming', 'ongoing', 'completed', 'cancelled') DEFAULT 'upcoming',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Buat tabel tickets
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    concert_id INT NOT NULL,
    ticket_type VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity_available INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (concert_id) REFERENCES concerts(id) ON DELETE CASCADE
);

-- Buat tabel orders
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'paid', 'cancelled', 'completed') DEFAULT 'pending',
    payment_method VARCHAR(50),
    payment_status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Buat tabel order_items
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    concert_id INT NOT NULL,
    ticket_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (concert_id) REFERENCES concerts(id) ON DELETE CASCADE,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE
);

-- Insert user dengan password password123
-- Password hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi

-- Insert admin user
INSERT INTO users (name, email, password, role, phone, address) VALUES 
('Administrator', 'admin@concert.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '081234567890', 'Jl. Admin No. 1');

-- Insert customer user
INSERT INTO users (name, email, password, role, phone, address) VALUES 
('John Doe', 'user@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '081234567891', 'Jl. User No. 1');

-- Insert sample concerts
INSERT INTO concerts (title, description, artist, venue, concert_date, ticket_price, total_tickets, available_tickets, status) VALUES
('Rock Concert 2024', 'Konser rock terbesar tahun 2024', 'Rock Band', 'Gelora Bung Karno', '2024-06-15 19:00:00', 500000, 1000, 1000, 'upcoming'),
('Pop Music Festival', 'Festival musik pop terbaik', 'Pop Stars', 'ICE BSD', '2024-07-20 20:00:00', 750000, 800, 800, 'upcoming'),
('Jazz Night', 'Malam jazz yang menenangkan', 'Jazz Ensemble', 'Taman Ismail Marzuki', '2024-08-10 21:00:00', 300000, 500, 500, 'upcoming'),
('Classical Symphony', 'Konser musik klasik', 'Philharmonic Orchestra', 'Aula Simfonia Jakarta', '2024-09-05 19:30:00', 1000000, 300, 300, 'upcoming'),
('Electronic Dance Music', 'EDM Festival terbesar', 'EDM DJs', 'Ancol Beach', '2024-10-12 22:00:00', 600000, 1200, 1200, 'upcoming');

-- Insert sample tickets
INSERT INTO tickets (concert_id, ticket_type, price, quantity_available) VALUES
(1, 'VIP', 1000000, 100),
(1, 'Regular', 500000, 900),
(2, 'VIP', 1500000, 80),
(2, 'Regular', 750000, 720),
(3, 'VIP', 600000, 50),
(3, 'Regular', 300000, 450),
(4, 'VIP', 2000000, 30),
(4, 'Regular', 1000000, 270),
(5, 'VIP', 1200000, 120),
(5, 'Regular', 600000, 1080);

-- Tampilkan hasil
SELECT 'Users created:' as info;
SELECT id, name, email, role FROM users;

SELECT 'Concerts created:' as info;
SELECT id, title, artist, venue, concert_date, ticket_price FROM concerts;

SELECT 'Tickets created:' as info;
SELECT id, concert_id, ticket_type, price, quantity_available FROM tickets; 