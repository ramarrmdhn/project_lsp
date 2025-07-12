<?php
/**
 * Script untuk insert user baru dengan password password123 melalui web browser
 * Akses: http://localhost/project_lsp/run_insert_users.php
 */

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'concert_ticket_system';

echo "<h1>Insert Users with Password 'password123'</h1>";
echo "<hr>";

try {
    // Koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✓ Berhasil terhubung ke database: $database</p>";
    
    // Password yang akan digunakan
    $password_hash = password_hash('password123', PASSWORD_DEFAULT);
    
    echo "<p><strong>Password:</strong> password123</p>";
    echo "<p><strong>Password hash:</strong> " . substr($password_hash, 0, 50) . "...</p>";
    
    // Hapus user yang ada (opsional)
    $stmt = $pdo->prepare("DELETE FROM users WHERE email IN (?, ?)");
    $stmt->execute(['admin@concert.com', 'user@example.com']);
    $deleted = $stmt->rowCount();
    echo "<p>✓ Deleted existing users: $deleted row(s)</p>";
    
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
    echo "<p>✓ Admin user inserted successfully</p>";
    
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
    echo "<p>✓ Customer user inserted successfully</p>";
    
    // Tampilkan hasil
    $stmt = $pdo->query("SELECT id, name, email, role, created_at FROM users ORDER BY id");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Daftar user yang berhasil dibuat:</h2>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Created At</th></tr>";
    
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . $user['id'] . "</td>";
        echo "<td>" . $user['name'] . "</td>";
        echo "<td>" . $user['email'] . "</td>";
        echo "<td>" . $user['role'] . "</td>";
        echo "<td>" . $user['created_at'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2 style='color: green;'>✓ User berhasil dibuat dengan password 'password123'!</h2>";
    echo "<h3>Sekarang Anda bisa login dengan:</h3>";
    echo "<ul>";
    echo "<li><strong>Admin:</strong> admin@concert.com / password123</li>";
    echo "<li><strong>User:</strong> user@example.com / password123</li>";
    echo "</ul>";
    
    echo "<h3>URL Login:</h3>";
    echo "<ul>";
    echo "<li><strong>Admin Login:</strong> <a href='http://localhost/project_lsp/admin/login' target='_blank'>http://localhost/project_lsp/admin/login</a></li>";
    echo "<li><strong>User Login:</strong> <a href='http://localhost/project_lsp/login' target='_blank'>http://localhost/project_lsp/login</a></li>";
    echo "</ul>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}
?> 