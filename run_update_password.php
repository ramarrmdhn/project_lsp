<?php
/**
 * Script untuk menjalankan update password melalui web browser
 * Akses: http://localhost/project_lsp/run_update_password.php
 */

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'concert_ticket_system';

echo "<h1>Update Password to 'password123'</h1>";
echo "<hr>";

try {
    // Koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✓ Berhasil terhubung ke database: $database</p>";
    
    // Password baru yang akan di-hash
    $new_password = 'password123';
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    echo "<p><strong>Password baru:</strong> $new_password</p>";
    echo "<p><strong>Password hash:</strong> " . substr($hashed_password, 0, 50) . "...</p>";
    
    // Update password untuk admin
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ? OR role = 'admin'");
    $stmt->execute([$hashed_password, 'admin@concert.com']);
    $admin_updated = $stmt->rowCount();
    echo "<p>✓ Admin password updated: $admin_updated row(s)</p>";
    
    // Update password untuk user biasa
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ? OR role = 'customer'");
    $stmt->execute([$hashed_password, 'user@example.com']);
    $user_updated = $stmt->rowCount();
    echo "<p>✓ User password updated: $user_updated row(s)</p>";
    
    // Update semua user yang ada
    $stmt = $pdo->prepare("UPDATE users SET password = ?");
    $stmt->execute([$hashed_password]);
    $total_updated = $stmt->rowCount();
    echo "<p>✓ Total users updated: $total_updated row(s)</p>";
    
    // Tampilkan hasil
    $stmt = $pdo->query("SELECT id, email, role, password FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Daftar user setelah update:</h2>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Email</th><th>Role</th><th>Password Hash</th></tr>";
    
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . $user['id'] . "</td>";
        echo "<td>" . $user['email'] . "</td>";
        echo "<td>" . $user['role'] . "</td>";
        echo "<td>" . substr($user['password'], 0, 30) . "...</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2 style='color: green;'>✓ Password berhasil diupdate menjadi 'password123' untuk semua user!</h2>";
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