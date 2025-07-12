-- Script untuk insert user dengan password password123
-- Password di-hash menggunakan password_hash() dengan PASSWORD_DEFAULT

-- Hapus user yang ada (opsional)
-- DELETE FROM users WHERE email IN ('admin@concert.com', 'user@example.com');

-- Insert admin user dengan password password123
INSERT INTO users (name, email, password, role, phone, address, created_at, updated_at) VALUES 
('Administrator', 'admin@concert.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '081234567890', 'Jl. Admin No. 1', NOW(), NOW());

-- Insert user customer dengan password password123
INSERT INTO users (name, email, password, role, phone, address, created_at, updated_at) VALUES 
('John Doe', 'user@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '081234567891', 'Jl. User No. 1', NOW(), NOW());

-- Tampilkan hasil
SELECT id, name, email, role, created_at FROM users; 