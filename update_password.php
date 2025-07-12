<?php
/**
 * Script untuk mengupdate password semua user menjadi password123
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
    
    // Password baru yang akan di-hash
    $new_password = 'password123';
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    echo "Password baru: $new_password\n";
    echo "Password hash: $hashed_password\n\n";
    
    // Update password untuk admin
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ? OR role = 'admin'");
    $stmt->execute([$hashed_password, 'admin@concert.com']);
    $admin_updated = $stmt->rowCount();
    echo "Admin password updated: $admin_updated row(s)\n";
    
    // Update password untuk user biasa
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ? OR role = 'customer'");
    $stmt->execute([$hashed_password, 'user@example.com']);
    $user_updated = $stmt->rowCount();
    echo "User password updated: $user_updated row(s)\n";
    
    // Update semua user yang ada
    $stmt = $pdo->prepare("UPDATE users SET password = ?");
    $stmt->execute([$hashed_password]);
    $total_updated = $stmt->rowCount();
    echo "Total users updated: $total_updated row(s)\n\n";
    
    // Tampilkan hasil
    $stmt = $pdo->query("SELECT id, email, role, password FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Daftar user setelah update:\n";
    echo "ID | Email | Role | Password Hash\n";
    echo "---|-------|-----|---------------\n";
    
    foreach ($users as $user) {
        echo $user['id'] . " | " . $user['email'] . " | " . $user['role'] . " | " . substr($user['password'], 0, 20) . "...\n";
    }
    
    echo "\nPassword berhasil diupdate menjadi 'password123' untuk semua user!\n";
    echo "Sekarang Anda bisa login dengan:\n";
    echo "- Admin: admin@concert.com / password123\n";
    echo "- User: user@example.com / password123\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 