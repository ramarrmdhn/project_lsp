# Flow Activity Pembelian Tiket Konser (Simple Format)

## 1. Main Flow - Proses Utama

```mermaid
graph TD;
    A[User Buka Website] --> B[Browse Konser];
    B --> C[Pilih Konser];
    C --> D[Lihat Detail Konser];
    D --> E[Pilih Tiket & Jumlah];
    E --> F{Klik Beli};
    F --> G{User Login?};
    G -->|Ya| H[Lanjut ke Pemesanan];
    G -->|Tidak| I[Redirect Login/Register];
    I --> J[Form Login];
    I --> K[Form Register];
    J --> L{Login Berhasil?};
    L -->|Ya| H;
    L -->|Tidak| J;
    K --> M{Register Berhasil?};
    M -->|Ya| H;
    M -->|Tidak| K;
    H --> N[Halaman Pemesanan];
    N --> O[Review Pesanan];
    O --> P[Isi Data Diri];
    P --> Q[Klik Lanjut ke Pembayaran];
    Q --> R[Halaman Checkout];
    R --> S[Pilih Metode Pembayaran];
    S --> T[Klik Bayar Sekarang];
    T --> U[Generate Nomor Pembayaran];
    U --> V[User Lakukan Pembayaran];
    V --> W{Sistem Deteksi Pembayaran};
    W -->|Otomatis| X[Status: Pembayaran Berhasil];
    W -->|Manual| Y[User Upload Bukti Transfer];
    Y --> Z[Admin Review Bukti];
    Z --> AA{Admin Konfirmasi};
    AA -->|Ya| X;
    AA -->|Tidak| BB[Status: Pembayaran Ditolak];
    BB --> Y;
    X --> CC[Sistem Generate Tiket PDF];
    CC --> DD[Generate QR Code];
    DD --> EE[Kirim Email Konfirmasi];
    EE --> FF[Kirim SMS Notifikasi];
    FF --> GG[User Download Tiket];
    GG --> HH[Pesanan Selesai];
```

## 2. Authentication Flow

```mermaid
graph TD;
    A{Klik Beli} --> B{User Login?};
    B -->|Ya| C[Lanjut ke Pemesanan];
    B -->|Tidak| D[Redirect Login/Register];
    D --> E{User Pilih};
    E -->|Login| F[Form Login];
    E -->|Register| G[Form Register];
    F --> H{Login Berhasil?};
    H -->|Ya| C;
    H -->|Tidak| F;
    G --> I{Register Berhasil?};
    I -->|Ya| C;
    I -->|Tidak| G;
```

## 3. Payment Methods Flow

```mermaid
graph TD;
    A[Pilih Metode Pembayaran] --> B[Transfer Bank];
    A --> C[E-Wallet];
    A --> D[Virtual Account];
    A --> E[Credit Card];
    B --> F[Upload Bukti Transfer];
    C --> G[Redirect ke E-Wallet];
    D --> H[Generate VA Number];
    E --> I[Redirect ke Payment Gateway];
    F --> J[Admin Review];
    G --> K[Auto Detection];
    H --> L[Auto Detection];
    I --> M[Auto Detection];
    J --> N{Konfirmasi};
    K --> O[Status: Paid];
    L --> O;
    M --> O;
    N -->|Ya| O;
    N -->|Tidak| P[Status: Rejected];
    P --> F;
```

## 4. Ticket Generation Flow

```mermaid
graph TD;
    A[Status: Paid] --> B[Generate Tiket PDF];
    B --> C[Generate QR Code];
    C --> D[Create Unique Ticket Number];
    D --> E[Send Email Confirmation];
    E --> F[Send SMS Notification];
    F --> G[User Download Tiket];
    G --> H[Pesanan Complete];
```

## 5. Error Handling Flow

```mermaid
graph TD;
    A[Error Occurs] --> B{Error Type};
    B -->|Stok Habis| C[Show Out of Stock];
    B -->|Login Failed| D[Show Error Message];
    B -->|Payment Failed| E[Show Payment Error];
    B -->|Session Timeout| F[Redirect to Login];
    B -->|Network Error| G[Show Retry Option];
    C --> H[Suggest Other Tickets];
    D --> I[Clear Form & Retry];
    E --> J[Choose Other Payment];
    F --> K[Save Cart Data];
    G --> L[Auto Retry];
    H --> M[Continue Shopping];
    I --> N[Login Again];
    J --> O[Payment Process];
    K --> P[Restore Cart];
    L --> Q[Continue Process];
```

## 6. Status Flow

```mermaid
graph TD;
    A[PENDING] --> B[PAID];
    A --> C[CANCELLED];
    A --> D[EXPIRED];
    B --> E[COMPLETED];
    B --> C;
    E --> F[END];
    C --> F;
    D --> F;
```

## 7. Shopping Cart Flow

```mermaid
graph TD;
    A[Pilih Tiket] --> B[Add to Cart];
    B --> C[View Cart];
    C --> D[Edit Quantity];
    C --> E[Remove Item];
    C --> F[Proceed to Checkout];
    D --> C;
    E --> C;
    F --> G[Checkout Process];
```

## 8. Admin Review Flow

```mermaid
graph TD;
    A[Payment Received] --> B[Admin Check];
    B --> C{Valid Payment?};
    C -->|Ya| D[Approve Payment];
    C -->|Tidak| E[Reject Payment];
    D --> F[Generate Tiket];
    E --> G[Notify User];
    G --> H[User Re-upload];
    H --> B;
    F --> I[Send Confirmation];
```

## 9. User Profile Flow

```mermaid
graph TD;
    A[User Dashboard] --> B[View Profile];
    A --> C[View Orders];
    A --> D[Download Tickets];
    A --> E[Edit Profile];
    C --> F[Order History];
    C --> G[Order Details];
    D --> H[Download PDF];
    E --> I[Update Information];
```

## 10. Complete User Journey

```mermaid
graph TD;
    A[Start] --> B[Browse Website];
    B --> C[Search Concert];
    C --> D[Select Concert];
    D --> E[Choose Tickets];
    E --> F[Login/Register];
    F --> G[Add to Cart];
    G --> H[Checkout];
    H --> I[Payment];
    I --> J[Confirmation];
    J --> K[Download Ticket];
    K --> L[End];
``` 