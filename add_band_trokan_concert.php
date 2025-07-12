<?php
// Script untuk menambahkan konser Band Trokan ke database
// Koneksi database langsung tanpa CodeIgniter

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'concert_ticket_system';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Berhasil terhubung ke database.\n";
    
    // Data konser Band Trokan
    $concert_data = [
        'title' => 'Band Trokan Live in Concert',
        'artist' => 'Band Trokan',
        'venue' => 'Gelora Bung Karno, Jakarta',
        'date_time' => '2024-06-15 19:00:00',
        'description' => 'Nikmati pengalaman musik yang tak terlupakan bersama Band Trokan dalam konser live mereka yang spektakuler! Konser ini akan menghadirkan lagu-lagu hits terbaik dari Band Trokan dengan aransemen musik yang memukau dan visual yang menakjubkan.',
        'additional_info' => 'Setlist: Lagu Hit #1, Lagu Hit #2, Lagu Hit #3, dan lagu-lagu hits lainnya. Fasilitas: Sound system berkualitas tinggi, lighting spektakuler, parkir luas, food & beverage, merchandise booth.',
        'capacity' => 80000,
        'available_tickets' => 500,
        'status' => 'active',
        'venue_address' => 'Jl. Pintu Satu Senayan, Jakarta Pusat',
        'image' => 'band_trokan.jpg',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    // Insert konser
    $sql = "INSERT INTO concerts (title, artist, venue, date_time, description, additional_info, capacity, available_tickets, status, venue_address, image, created_at, updated_at) 
            VALUES (:title, :artist, :venue, :date_time, :description, :additional_info, :capacity, :available_tickets, :status, :venue_address, :image, :created_at, :updated_at)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($concert_data);
    
    $concert_id = $pdo->lastInsertId();
    echo "Konser Band Trokan berhasil ditambahkan dengan ID: $concert_id\n";
    
    // Data tiket untuk Band Trokan
    $tickets_data = [
        [
            'concert_id' => $concert_id,
            'category' => 'VIP',
            'description' => 'Area terdepan, akses eksklusif, merchandise gratis',
            'price' => 1500000,
            'available' => 100,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ],
        [
            'concert_id' => $concert_id,
            'category' => 'Regular',
            'description' => 'Area tengah, pengalaman musik yang nyaman',
            'price' => 800000,
            'available' => 300,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ],
        [
            'concert_id' => $concert_id,
            'category' => 'Economy',
            'description' => 'Area belakang, harga terjangkau',
            'price' => 500000,
            'available' => 100,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]
    ];
    
    // Insert tiket
    $ticket_sql = "INSERT INTO tickets (concert_id, category, description, price, available, created_at, updated_at) 
                    VALUES (:concert_id, :category, :description, :price, :available, :created_at, :updated_at)";
    
    $ticket_stmt = $pdo->prepare($ticket_sql);
    
    foreach ($tickets_data as $ticket) {
        $ticket_stmt->execute($ticket);
        echo "Tiket {$ticket['category']} berhasil ditambahkan.\n";
    }
    
    echo "\nKonser Band Trokan berhasil ditambahkan ke sistem konser utama!\n";
    echo "Anda dapat mengakses konser ini melalui halaman konser utama.\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 