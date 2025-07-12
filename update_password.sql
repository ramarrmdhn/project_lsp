-- Script untuk mengupdate password semua user menjadi password123
-- Password di-hash menggunakan password_hash() dengan PASSWORD_DEFAULT

-- Update password untuk admin
UPDATE users SET 
    password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE email = 'admin@concert.com' OR role = 'admin';

-- Update password untuk user biasa
UPDATE users SET 
    password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE email = 'user@example.com' OR role = 'customer';

-- Update semua user yang ada (jika ada user lain)
UPDATE users SET 
    password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

-- Tampilkan hasil update
SELECT id, email, role, password FROM users; 