# Activity Diagram - Flow Pembelian Tiket Konser

```mermaid
flowchart TD
    A[User Buka Website] --> B[Browse Konser]
    B --> C[Pilih Konser]
    C --> D[Lihat Detail Konser]
    D --> E[Pilih Tiket & Jumlah]
    E --> F{Klik Beli}
    F --> G{User Login?}
    
    G -->|Tidak| H[Redirect ke Login/Register]
    H --> I{User Pilih}
    I -->|Login| J[Form Login]
    I -->|Register| K[Form Register]
    
    J --> L{Login Berhasil?}
    L -->|Ya| M[Redirect ke Pemesanan]
    L -->|Tidak| J
    
    K --> N{Register Berhasil?}
    N -->|Ya| M
    N -->|Tidak| K
    
    G -->|Ya| M
    
    M --> O[Halaman Pemesanan]
    O --> P[Review Pesanan]
    P --> Q[Isi Data Diri]
    Q --> R[Klik Lanjut ke Pembayaran]
    
    R --> S[Halaman Checkout]
    S --> T[Pilih Metode Pembayaran]
    T --> U[Klik Bayar Sekarang]
    
    U --> V[Generate Nomor Pembayaran]
    V --> W[User Lakukan Pembayaran]
    W --> X{Sistem Deteksi Pembayaran}
    
    X -->|Otomatis| Y[Status: Pembayaran Berhasil]
    X -->|Manual| Z[User Upload Bukti Transfer]
    Z --> AA[Admin Review Bukti]
    AA --> BB{Admin Konfirmasi}
    BB -->|Ya| Y
    BB -->|Tidak| CC[Status: Pembayaran Ditolak]
    CC --> Z
    
    Y --> DD[Sistem Generate Tiket PDF]
    DD --> EE[Generate QR Code]
    EE --> FF[Kirim Email Konfirmasi]
    FF --> GG[Kirim SMS Notifikasi]
    GG --> HH[User Download Tiket]
    HH --> II[Pesanan Selesai]
    
    style A fill:#e1f5fe
    style II fill:#c8e6c9
    style CC fill:#ffcdd2
```

## Detail Flow Activity

### **Phase 1: Browse & Selection**
```mermaid
flowchart LR
    A[Homepage] --> B[Search/Filter]
    B --> C[Pilih Konser]
    C --> D[Detail Konser]
    D --> E[Pilih Tiket]
    E --> F[Klik Beli]
    
    style A fill:#e1f5fe
    style F fill:#fff3e0
```

### **Phase 2: Authentication**
```mermaid
flowchart TD
    A{Klik Beli} --> B{User Login?}
    B -->|Ya| C[Lanjut ke Pemesanan]
    B -->|Tidak| D[Redirect Login/Register]
    D --> E{User Pilih}
    E -->|Login| F[Form Login]
    E -->|Register| G[Form Register]
    
    F --> H{Login Berhasil?}
    H -->|Ya| C
    H -->|Tidak| F
    
    G --> I{Register Berhasil?}
    I -->|Ya| C
    I -->|Tidak| G
    
    style A fill:#fff3e0
    style C fill:#e8f5e8
```

### **Phase 3: Checkout Process**
```mermaid
flowchart TD
    A[Pemesanan] --> B[Review Pesanan]
    B --> C[Isi Data Diri]
    C --> D[Pilih Pembayaran]
    D --> E[Proses Pembayaran]
    E --> F{Konfirmasi Pembayaran}
    F -->|Berhasil| G[Generate Tiket]
    F -->|Gagal| H[Retry Pembayaran]
    H --> E
    
    style A fill:#e8f5e8
    style G fill:#c8e6c9
```

### **Phase 4: Payment & Confirmation**
```mermaid
flowchart TD
    A[Pilih Metode Pembayaran] --> B[Transfer Bank]
    A --> C[E-Wallet]
    A --> D[Virtual Account]
    A --> E[Credit Card]
    
    B --> F[Upload Bukti Transfer]
    C --> G[Redirect ke E-Wallet]
    D --> H[Generate VA Number]
    E --> I[Redirect ke Payment Gateway]
    
    F --> J[Admin Review]
    G --> K[Auto Detection]
    H --> L[Auto Detection]
    I --> M[Auto Detection]
    
    J --> N{Konfirmasi}
    K --> O[Status: Paid]
    L --> O
    M --> O
    
    N -->|Ya| O
    N -->|Tidak| P[Status: Rejected]
    P --> F
    
    style O fill:#c8e6c9
    style P fill:#ffcdd2
```

### **Phase 5: Ticket Generation**
```mermaid
flowchart TD
    A[Status: Paid] --> B[Generate Tiket PDF]
    B --> C[Generate QR Code]
    C --> D[Create Unique Ticket Number]
    D --> E[Send Email Confirmation]
    E --> F[Send SMS Notification]
    F --> G[User Download Tiket]
    G --> H[Pesanan Complete]
    
    style A fill:#c8e6c9
    style H fill:#4caf50
```

## Status Flow Diagram

```mermaid
stateDiagram-v2
    [*] --> Pending
    Pending --> Paid: Payment Success
    Pending --> Cancelled: User Cancel
    Pending --> Expired: Timeout
    
    Paid --> Completed: Ticket Downloaded
    Paid --> Cancelled: Admin Cancel
    
    Completed --> [*]
    Cancelled --> [*]
    Expired --> [*]
```

## Error Handling Flow

```mermaid
flowchart TD
    A[Error Occurs] --> B{Error Type}
    
    B -->|Stok Habis| C[Show Out of Stock]
    B -->|Login Failed| D[Show Error Message]
    B -->|Payment Failed| E[Show Payment Error]
    B -->|Session Timeout| F[Redirect to Login]
    B -->|Network Error| G[Show Retry Option]
    
    C --> H[Suggest Other Tickets]
    D --> I[Clear Form & Retry]
    E --> J[Choose Other Payment]
    F --> K[Save Cart Data]
    G --> L[Auto Retry]
    
    H --> M[Continue Shopping]
    I --> N[Login Again]
    J --> O[Payment Process]
    K --> P[Restore Cart]
    L --> Q[Continue Process]
    
    style A fill:#ffcdd2
    style M fill:#e8f5e8
    style N fill:#e8f5e8
    style O fill:#e8f5e8
    style P fill:#e8f5e8
    style Q fill:#e8f5e8
```

## Timeline Flow

```mermaid
gantt
    title Timeline Pembelian Tiket
    dateFormat  HH:mm
    section Browse
    Buka Website    :a1, 00:00, 2m
    Pilih Konser    :a2, after a1, 5m
    Pilih Tiket     :a3, after a2, 3m
    
    section Auth
    Login/Register  :b1, after a3, 5m
    
    section Checkout
    Review Pesanan  :c1, after b1, 3m
    Pilih Pembayaran :c2, after c1, 2m
    
    section Payment
    Lakukan Pembayaran :d1, after c2, 15m
    Konfirmasi      :d2, after d1, 5m
    
    section Complete
    Generate Tiket  :e1, after d2, 2m
    Download Tiket  :e2, after e1, 2m
``` 