<?php
/**
 * Script untuk insert user dengan password password123
 * Jalankan script ini melalui browser atau command line
 */

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'concert_ticket_system';

try {
    // Koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Berhasil terhubung ke database: $database\n";
    
    // Password yang akan digunakan
    $password_hash = password_hash('password123', PASSWORD_DEFAULT);
    
    echo "Password: password123\n";
    echo "Password hash: $password_hash\n\n";
    
    // Hapus user yang ada (opsional)
    $stmt = $pdo->prepare("DELETE FROM users WHERE email IN (?, ?)");
    $stmt->execute(['admin@concert.com', 'user@example.com']);
    $deleted = $stmt->rowCount();
    echo "Deleted existing users: $deleted row(s)\n";
    
    // Insert admin user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, phone, address, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
    $stmt->execute([
        'Administrator',
        'admin@concert.com',
        $password_hash,
        'admin',
        '081234567890',
        'Jl. Admin No. 1'
    ]);
    echo "Admin user inserted successfully\n";
    
    // Insert customer user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, phone, address, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
    $stmt->execute([
        'John Doe',
        'user@example.com',
        $password_hash,
        'customer',
        '081234567891',
        'Jl. User No. 1'
    ]);
    echo "Customer user inserted successfully\n\n";
    
    // Tampilkan hasil
    $stmt = $pdo->query("SELECT id, name, email, role, created_at FROM users ORDER BY id");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Daftar user yang berhasil dibuat:\n";
    echo "ID | Name | Email | Role | Created At\n";
    echo "---|------|-------|-----|------------\n";
    
    foreach ($users as $user) {
        echo $user['id'] . " | " . $user['name'] . " | " . $user['email'] . " | " . $user['role'] . " | " . $user['created_at'] . "\n";
    }
    
    echo "\nUser berhasil dibuat dengan password 'password123'!\n";
    echo "Sekarang Anda bisa login dengan:\n";
    echo "- Admin: admin@concert.com / password123\n";
    echo "- User: user@example.com / password123\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 