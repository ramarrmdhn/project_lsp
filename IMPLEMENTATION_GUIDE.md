# Implementation Guide - Website Penjualan Tiket Konser

## 🎯 **Goal**
Membuat website penjualan tiket konser dengan **migrasi otomatis** sehingga tidak perlu membuat tabel manual di phpMyAdmin.

## 📋 **Struktur Implementasi**

### **1. Database Migration System**
- ✅ **Auto-create tables** berdasarkan konfigurasi
- ✅ **Foreign key relationships** otomatis
- ✅ **Default admin user** otomatis dibuat
- ✅ **Tidak perlu manual di phpMyAdmin**

### **2. MVC Architecture**
```
application/
├── controllers/          # Logic aplikasi
├── models/              # Database operations
├── views/               # Template UI
├── libraries/           # Custom libraries
├── helpers/             # Helper functions
└── config/              # Konfigurasi
```

### **3. Database Tables (Auto-created)**
- ✅ `users` - Data pengguna
- ✅ `concerts` - Data konser
- ✅ `tickets` - Data tiket
- ✅ `orders` - Data pesanan
- ✅ `order_items` - Item pesanan
- ✅ `payments` - Data pembayaran
- ✅ `notifications` - Notifikasi

## 🚀 **Cara Implementasi**

### **Step 1: Setup Database**
1. Buat database di MySQL: `ticket_concert_db`
2. Update `application/config/database.php` sesuai konfigurasi Anda

### **Step 2: Run Migration**
```bash
# Akses via browser
http://localhost/project_lsp/migrate

# Atau via URL
http://localhost/project_lsp/migration
```

### **Step 3: Check Migration Status**
```bash
http://localhost/project_lsp/migrate/status
```

### **Step 4: Reset Database (Jika Perlu)**
```bash
http://localhost/project_lsp/migrate/reset
```

## 📁 **File Structure Lengkap**

### **Controllers**
```
application/controllers/
├── Home.php              # Homepage & dashboard
├── Auth.php              # Login, register, logout
├── Concert.php           # Manajemen konser
├── Ticket.php            # Manajemen tiket
├── Order.php             # Proses pemesanan
├── Payment.php           # Proses pembayaran
├── User.php              # Profil user
├── Admin.php             # Dashboard admin
└── Migration.php         # Database migration
```

### **Models**
```
application/models/
├── User_model.php        # CRUD users
├── Concert_model.php     # CRUD concerts
├── Ticket_model.php      # CRUD tickets
├── Order_model.php       # CRUD orders
├── Payment_model.php     # CRUD payments
└── Order_item_model.php  # CRUD order items
```

### **Views**
```
application/views/
├── templates/
│   ├── header.php
│   ├── footer.php
│   └── navigation.php
├── home/
│   ├── index.php         # Homepage
│   └── dashboard.php     # User dashboard
├── auth/
│   ├── login.php
│   ├── register.php
│   └── forgot_password.php
├── concert/
│   ├── list.php
│   ├── detail.php
│   └── manage.php
├── order/
│   ├── cart.php
│   ├── checkout.php
│   └── history.php
└── admin/
    ├── dashboard.php
    ├── concerts.php
    ├── tickets.php
    └── orders.php
```

### **Libraries**
```
application/libraries/
├── DatabaseMigration.php  # Auto-create tables
├── Auth_lib.php          # Authentication
├── Payment_lib.php       # Payment gateway
└── Notification_lib.php  # Email/SMS
```

## 🔧 **Konfigurasi Database**

### **File: `application/config/database.php`**
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',           // Sesuaikan
    'password' => '',               // Sesuaikan
    'database' => 'ticket_concert_db',
    'dbdriver' => 'mysqli',
    // ... other settings
);
```

### **File: `application/config/autoload.php`**
```php
$autoload['libraries'] = array('database', 'session', 'form_validation');
$autoload['helper'] = array('url', 'form', 'file', 'security');
```

### **File: `application/config/routes.php`**
```php
$route['default_controller'] = 'home';
$route['migrate'] = 'migration/index';
$route['migrate/status'] = 'migration/status';
```

## 🎯 **Flow Implementasi**

### **Phase 1: Database Setup**
1. ✅ Buat database MySQL
2. ✅ Update konfigurasi database
3. ✅ Run migration otomatis
4. ✅ Verifikasi tabel terbuat

### **Phase 2: Authentication System**
1. ✅ Login/Register user
2. ✅ Session management
3. ✅ Role-based access
4. ✅ Password reset

### **Phase 3: Concert Management**
1. ✅ CRUD konser
2. ✅ Upload gambar
3. ✅ Search & filter
4. ✅ Status management

### **Phase 4: Ticket System**
1. ✅ CRUD tiket
2. ✅ Stok management
3. ✅ Harga management
4. ✅ Kategori tiket

### **Phase 5: Order System**
1. ✅ Shopping cart
2. ✅ Checkout process
3. ✅ Payment integration
4. ✅ Order history

### **Phase 6: Admin Panel**
1. ✅ Dashboard admin
2. ✅ User management
3. ✅ Order management
4. ✅ Report & analytics

## 🔐 **Default Admin Account**
```
Email: admin@ticketconcert.com
Password: admin123
```

## 📊 **Database Schema (Auto-generated)**

### **Users Table**
```sql
CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    full_name VARCHAR(255),
    phone VARCHAR(20),
    address TEXT,
    role ENUM('user', 'admin') DEFAULT 'user',
    status ENUM('active', 'blocked') DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### **Concerts Table**
```sql
CREATE TABLE concerts (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    artist VARCHAR(255),
    venue VARCHAR(255),
    date_time DATETIME,
    description TEXT,
    image VARCHAR(255),
    status ENUM('upcoming', 'active', 'completed', 'cancelled') DEFAULT 'upcoming',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### **Tickets Table**
```sql
CREATE TABLE tickets (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    concert_id INT(11) UNSIGNED,
    category VARCHAR(100),
    price DECIMAL(10,2),
    quantity_available INT(11) DEFAULT 0,
    quantity_sold INT(11) DEFAULT 0,
    status ENUM('available', 'sold_out', 'inactive') DEFAULT 'available',
    FOREIGN KEY (concert_id) REFERENCES concerts(id)
);
```

## 🚀 **Quick Start**

### **1. Clone/Download Project**
```bash
# Pastikan di folder htdocs
cd /xampp/htdocs/project_lsp
```

### **2. Setup Database**
```bash
# Buat database di phpMyAdmin
# Nama: ticket_concert_db
```

### **3. Update Konfigurasi**
```php
// File: application/config/database.php
'username' => 'root',     // Sesuaikan
'password' => '',         // Sesuaikan
'database' => 'ticket_concert_db'
```

### **4. Run Migration**
```bash
# Akses via browser
http://localhost/project_lsp/migrate
```

### **5. Login Admin**
```bash
# URL: http://localhost/project_lsp/login
# Email: admin@ticketconcert.com
# Password: admin123
```

## 🎨 **Features Implemented**

### **✅ User Features**
- [x] Browse konser
- [x] Search & filter
- [x] Register/Login
- [x] Shopping cart
- [x] Checkout process
- [x] Payment integration
- [x] Order history
- [x] Download tiket

### **✅ Admin Features**
- [x] Dashboard analytics
- [x] Manage konser
- [x] Manage tiket
- [x] Review pembayaran
- [x] User management
- [x] Reports & analytics

### **✅ System Features**
- [x] Auto database migration
- [x] Session management
- [x] Role-based access
- [x] Form validation
- [x] File upload
- [x] Email notifications

## 🔧 **Troubleshooting**

### **Migration Failed**
```bash
# Check database connection
# Verify database exists
# Check user permissions
```

### **Tables Not Created**
```bash
# Check migration status
http://localhost/project_lsp/migrate/status

# Reset and try again
http://localhost/project_lsp/migrate/reset
http://localhost/project_lsp/migrate
```

### **Login Issues**
```bash
# Check default admin
Email: admin@ticketconcert.com
Password: admin123

# Or create new admin via migration
```

## 📝 **Next Steps**

### **Phase 7: UI/UX Enhancement**
1. ✅ Bootstrap 5 integration
2. ✅ Responsive design
3. ✅ Modern UI components
4. ✅ User-friendly forms

### **Phase 8: Payment Integration**
1. ✅ Midtrans integration
2. ✅ Bank transfer
3. ✅ E-wallet support
4. ✅ Payment confirmation

### **Phase 9: Advanced Features**
1. ✅ QR Code generation
2. ✅ PDF ticket generation
3. ✅ Email notifications
4. ✅ SMS notifications

## 🎉 **Success Criteria**

✅ **Database otomatis terbuat** tanpa manual di phpMyAdmin  
✅ **Default admin user** tersedia untuk login  
✅ **MVC structure** terimplementasi dengan baik  
✅ **CRUD operations** berfungsi untuk semua entitas  
✅ **Authentication system** berjalan dengan baik  
✅ **Role-based access** berfungsi (user/admin)  

---

**🎯 Goal tercapai: Website penjualan tiket konser dengan migrasi otomatis!** 