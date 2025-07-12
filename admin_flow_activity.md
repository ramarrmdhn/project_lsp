# Flow Activity Admin - Website Penjualan Tiket Konser

## 1. Admin Login Flow

```mermaid
graph TD;
    A[Admin Buka Website] --> B[Klik Login Admin];
    B --> C[Form Login Admin];
    C --> D[Input Username/Password];
    D --> E{Validasi Login};
    E -->|Berhasil| F[Redirect ke Dashboard Admin];
    E -->|Gagal| G[Show Error Message];
    G --> C;
    F --> H[Admin Dashboard];
```

## 2. Admin Dashboard Flow

```mermaid
graph TD;
    A[Admin Dashboard] --> B[View Statistik];
    A --> C[View Pesanan Terbaru];
    A --> D[View Konser Aktif];
    A --> E[View Pembayaran Pending];
    A --> F[View Laporan];
    B --> G[Chart Penjualan];
    B --> H[Chart Pendapatan];
    C --> I[Detail Pesanan];
    D --> J[Detail Konser];
    E --> K[Review Pembayaran];
    F --> L[Export Laporan];
```

## 3. Manajemen Konser Flow

```mermaid
graph TD;
    A[Menu Konser] --> B[View Daftar Konser];
    B --> C[Tambah Konser Baru];
    B --> D[Edit Konser];
    B --> E[Hapus Konser];
    B --> F[Detail Konser];
    C --> G[Form Tambah Konser];
    G --> H[Input Data Konser];
    H --> I[Upload Gambar];
    I --> J{Validasi Data};
    J -->|Berhasil| K[Simpan Konser];
    J -->|Gagal| L[Show Error];
    L --> G;
    K --> M[Konser Tersimpan];
    D --> N[Form Edit Konser];
    N --> O[Update Data];
    O --> P{Validasi Update};
    P -->|Berhasil| Q[Update Berhasil];
    P -->|Gagal| R[Show Error];
    R --> N;
    E --> S{Konfirmasi Hapus};
    S -->|Ya| T[Hapus Konser];
    S -->|Tidak| U[Batal Hapus];
    T --> V[Konser Terhapus];
```

## 4. Manajemen Tiket Flow

```mermaid
graph TD;
    A[Menu Tiket] --> B[View Daftar Tiket];
    B --> C[Tambah Tiket Baru];
    B --> D[Edit Tiket];
    B --> E[Hapus Tiket];
    B --> F[Set Harga];
    C --> G[Pilih Konser];
    G --> H[Input Data Tiket];
    H --> I[Set Kategori];
    I --> J[Set Harga];
    J --> K[Set Stok];
    K --> L{Validasi Data};
    L -->|Berhasil| M[Simpan Tiket];
    L -->|Gagal| N[Show Error];
    N --> G;
    M --> O[Tiket Tersimpan];
    D --> P[Form Edit Tiket];
    P --> Q[Update Data Tiket];
    Q --> R{Validasi Update};
    R -->|Berhasil| S[Update Berhasil];
    R -->|Gagal| T[Show Error];
    T --> P;
    F --> U[Form Set Harga];
    U --> V[Input Harga Baru];
    V --> W[Update Harga];
    W --> X[Harga Terupdate];
```

## 5. Review Pembayaran Flow

```mermaid
graph TD;
    A[Menu Pembayaran] --> B[View Pembayaran Pending];
    B --> C[View Detail Pembayaran];
    C --> D[Lihat Bukti Transfer];
    D --> E{Validasi Bukti};
    E -->|Valid| F[Approve Pembayaran];
    E -->|Tidak Valid| G[Reject Pembayaran];
    F --> H[Generate Tiket];
    H --> I[Kirim Email Konfirmasi];
    I --> J[Update Status Paid];
    G --> K[Kirim Email Rejection];
    K --> L[Update Status Rejected];
    L --> M[User Re-upload Bukti];
    M --> C;
```

## 6. Manajemen Pesanan Flow

```mermaid
graph TD;
    A[Menu Pesanan] --> B[View Semua Pesanan];
    B --> C[Filter Pesanan];
    B --> D[Search Pesanan];
    B --> E[View Detail Pesanan];
    C --> F[Filter by Status];
    C --> G[Filter by Date];
    C --> H[Filter by Konser];
    D --> I[Search by Order ID];
    D --> J[Search by User];
    E --> K[Lihat Detail User];
    E --> L[Lihat Detail Tiket];
    E --> M[Lihat Status Pembayaran];
    E --> N[Update Status Pesanan];
    N --> O[Set Status Completed];
    N --> P[Set Status Cancelled];
    O --> Q[Pesanan Complete];
    P --> R[Pesanan Cancelled];
```

## 7. Manajemen User Flow

```mermaid
graph TD;
    A[Menu User] --> B[View Daftar User];
    B --> C[Search User];
    B --> D[View Detail User];
    B --> E[Block User];
    B --> F[Unblock User];
    B --> G[Reset Password User];
    C --> H[Search by Username];
    C --> I[Search by Email];
    D --> J[Lihat Riwayat Pesanan];
    D --> K[Lihat Data Pribadi];
    E --> L{Konfirmasi Block};
    L -->|Ya| M[Block User];
    L -->|Tidak| N[Batal Block];
    F --> O{Konfirmasi Unblock};
    O -->|Ya| P[Unblock User];
    O -->|Tidak| Q[Batal Unblock];
    G --> R{Konfirmasi Reset Password};
    R -->|Ya| S[Reset Password];
    R -->|Tidak| T[Batal Reset];
    S --> U[Kirim Email Password Baru];
```

## 8. Laporan & Analytics Flow

```mermaid
graph TD;
    A[Menu Laporan] --> B[Laporan Penjualan];
    A --> C[Laporan Konser];
    A --> D[Laporan User];
    A --> E[Laporan Pembayaran];
    A --> F[Analytics Dashboard];
    B --> G[Filter by Periode];
    B --> H[Filter by Konser];
    B --> I[Export Excel];
    B --> J[Export PDF];
    C --> K[Statistik Konser];
    C --> L[Pendapatan per Konser];
    C --> M[Stok Tiket];
    D --> N[User Registration];
    D --> O[User Activity];
    D --> P[Top Users];
    E --> Q[Metode Pembayaran];
    E --> R[Status Pembayaran];
    E --> S[Payment Success Rate];
    F --> T[Chart Penjualan];
    F --> U[Chart Pendapatan];
    F --> V[Chart Konser Populer];
```

## 9. Notifikasi Admin Flow

```mermaid
graph TD;
    A[Admin Dashboard] --> B[Check Notifikasi];
    B --> C[Pembayaran Baru];
    B --> D[Stok Tiket Habis];
    B --> E[Konser Akan Dimulai];
    B --> F[User Baru Register];
    C --> G[Review Pembayaran];
    D --> H[Update Stok];
    E --> I[Send Reminder];
    F --> J[Welcome Email];
    G --> K[Approve/Reject];
    H --> L[Restock Tiket];
    I --> M[Email Reminder];
    J --> N[Email Welcome];
```

## 10. Settings Admin Flow

```mermaid
graph TD;
    A[Menu Settings] --> B[Profile Admin];
    A --> C[Password Admin];
    A --> D[Website Settings];
    A --> E[Payment Settings];
    A --> F[Email Settings];
    B --> G[Edit Profile];
    B --> H[Upload Foto];
    C --> I[Change Password];
    C --> J[Reset Password];
    D --> K[Site Title];
    D --> L[Site Description];
    D --> M[Contact Info];
    E --> N[Payment Gateway];
    E --> O[Bank Accounts];
    F --> P[SMTP Settings];
    F --> Q[Email Templates];
```

## 11. Complete Admin Workflow

```mermaid
graph TD;
    A[Admin Login] --> B[Dashboard];
    B --> C[Review Pembayaran];
    B --> D[Manage Konser];
    B --> E[Manage Tiket];
    B --> F[View Laporan];
    C --> G[Approve Payment];
    C --> H[Reject Payment];
    D --> I[Add/Edit Konser];
    E --> J[Add/Edit Tiket];
    F --> K[Export Data];
    G --> L[Generate Tiket];
    H --> M[Notify User];
    I --> N[Konser Updated];
    J --> O[Tiket Updated];
    K --> P[Laporan Ready];
    L --> Q[Email Sent];
    M --> R[User Notified];
    N --> S[Website Updated];
    O --> T[Inventory Updated];
    P --> U[Data Exported];
    Q --> V[Process Complete];
    R --> W[Process Complete];
    S --> X[Process Complete];
    T --> Y[Process Complete];
    U --> Z[Process Complete];
    V --> AA[End];
    W --> AA;
    X --> AA;
    Y --> AA;
    Z --> AA;
```

## 12. Admin Security Flow

```mermaid
graph TD;
    A[Admin Access] --> B{Valid Session?};
    B -->|Ya| C[Allow Access];
    B -->|Tidak| D[Redirect Login];
    C --> E[Check Permission];
    E -->|Admin| F[Full Access];
    E -->|Staff| G[Limited Access];
    F --> H[All Features];
    G --> I[View Only];
    D --> J[Login Form];
    J --> K{Login Valid?};
    K -->|Ya| C;
    K -->|Tidak| L[Show Error];
    L --> J;
``` 