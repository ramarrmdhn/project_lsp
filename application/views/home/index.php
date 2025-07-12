<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Temukan Pengalaman Konser Sempurna Anda</h1>
                <p class="lead mb-4">Temukan dan pesan tiket untuk konser terbaik di Indonesia. Dari superstar internasional hingga favorit lokal, kami punya semuanya.</p>
                <div class="d-flex gap-3">
                    <a href="<?php echo base_url('concerts'); ?>" class="btn btn-light btn-lg">
                        <i class="fas fa-search me-2"></i>Jelajahi Konser
                    </a>
                    <a href="<?php echo base_url('band-trokan'); ?>" class="btn btn-warning btn-lg">
                        <i class="fas fa-star me-2"></i>Band Trokan Live!
                    </a>
                    <?php if(!$this->session->userdata('user_id')): ?>
                        <a href="<?php echo base_url('register'); ?>" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-music fa-8x text-white-50"></i>
            </div>
        </div>
    </div>
</section>

<!-- Band Trokan Special Section -->
<section class="py-5 bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold text-white mb-3">Band Trokan Live in Concert</h2>
                <p class="text-white-50 mb-4">
                    Jangan lewatkan konser spektakuler Band Trokan! Nikmati musik terbaik dengan visual yang memukau di Gelora Bung Karno, Jakarta.
                </p>
                <div class="mb-4">
                    <div class="d-flex align-items-center text-white mb-2">
                        <i class="fas fa-map-marker-alt me-3"></i>
                        <span>Gelora Bung Karno, Jakarta</span>
                    </div>
                    <div class="d-flex align-items-center text-white mb-2">
                        <i class="fas fa-calendar me-3"></i>
                        <span>Sabtu, 15 Juni 2024 - 19:00 WIB</span>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <i class="fas fa-ticket-alt me-3"></i>
                        <span>Mulai dari Rp 500,000</span>
                    </div>
                </div>
                <a href="<?php echo base_url('band-trokan'); ?>" class="btn btn-warning btn-lg">
                    <i class="fas fa-star me-2"></i>Beli Tiket Sekarang!
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <div class="bg-white bg-opacity-10 rounded p-4">
                    <i class="fas fa-music fa-6x text-white mb-3"></i>
                    <h4 class="text-white mb-0">Band Trokan</h4>
                    <p class="text-white-50 mb-0">Live in Concert</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Concerts -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2 class="fw-bold">Konser Unggulan</h2>
                <p class="text-muted">Jangan lewatkan konser-konser menakjubkan yang akan datang</p>
            </div>
            <div class="col-lg-4 text-end">
                <a href="<?php echo base_url('concerts'); ?>" class="btn btn-outline-primary">Lihat Semua Konser</a>
            </div>
        </div>

        <div class="row">
            <?php if(isset($concerts) && !empty($concerts)): ?>
                <?php foreach($concerts as $concert): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card concert-card h-100">
                            <?php if($concert->image): ?>
                                <img src="<?php echo base_url('uploads/concerts/' . $concert->image); ?>" class="card-img-top" alt="<?php echo $concert->title; ?>">
                            <?php else: ?>
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-music fa-3x text-muted"></i>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $concert->title; ?></h5>
                                <p class="card-text text-muted">
                                    <i class="fas fa-user me-1"></i><?php echo $concert->artist; ?>
                                </p>
                                <p class="card-text">
                                    <i class="fas fa-map-marker-alt me-1 text-danger"></i><?php echo $concert->venue; ?>
                                </p>
                                <p class="card-text">
                                    <i class="fas fa-calendar me-1 text-primary"></i>
                                    <?php echo date('d M Y H:i', strtotime($concert->date_time)); ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-<?php echo $concert->status == 'upcoming' ? 'primary' : ($concert->status == 'active' ? 'success' : 'secondary'); ?>">
                                        <?php echo ucfirst($concert->status); ?>
                                    </span>
                                    <a href="<?php echo base_url('concert/' . $concert->id); ?>" class="btn btn-primary btn-sm">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-music fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Tidak ada konser tersedia saat ini</h4>
                    <p class="text-muted">Cek kembali nanti untuk konser yang akan datang!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Popular Concerts -->
<?php if(isset($popular) && !empty($popular)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2 class="fw-bold">Konser Populer</h2>
                <p class="text-muted">Konser paling banyak dipesan oleh pengguna kami</p>
            </div>
        </div>

        <div class="row">
            <?php foreach($popular as $concert): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card concert-card h-100">
                        <?php if($concert->image): ?>
                            <img src="<?php echo base_url('uploads/concerts/' . $concert->image); ?>" class="card-img-top" alt="<?php echo $concert->title; ?>">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-music fa-3x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $concert->title; ?></h5>
                            <p class="card-text text-muted">
                                <i class="fas fa-user me-1"></i><?php echo $concert->artist; ?>
                            </p>
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt me-1 text-danger"></i><?php echo $concert->venue; ?>
                            </p>
                            <p class="card-text">
                                <i class="fas fa-calendar me-1 text-primary"></i>
                                <?php echo date('d M Y H:i', strtotime($concert->date_time)); ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">
                                    <i class="fas fa-fire me-1"></i>Populer
                                </span>
                                <a href="<?php echo base_url('concert/' . $concert->id); ?>" class="btn btn-primary btn-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">Mengapa Memilih Ticket Concert?</h2>
                <p class="text-muted">Kami menyediakan pengalaman pemesanan tiket konser terbaik</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt fa-2x text-primary"></i>
                    </div>
                    <h5>Pemesanan Aman</h5>
                    <p class="text-muted">Proses pembayaran yang aman dan terpercaya dengan berbagai opsi pembayaran.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-ticket-alt fa-2x text-success"></i>
                    </div>
                    <h5>Tiket Instan</h5>
                    <p class="text-muted">Dapatkan tiket Anda secara instan setelah konfirmasi pembayaran.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-headset fa-2x text-warning"></i>
                    </div>
                    <h5>Dukungan 24/7</h5>
                    <p class="text-muted">Dukungan pelanggan 24 jam untuk membantu Anda dengan masalah apapun.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-mobile-alt fa-2x text-info"></i>
                    </div>
                    <h5>Ramah Mobile</h5>
                    <p class="text-muted">Pesan tiket dengan mudah dari perangkat mobile Anda di mana saja, kapan saja.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="fw-bold mb-3">Tetap Terupdate</h3>
                <p class="mb-4">Berlangganan newsletter kami untuk mendapatkan update terbaru tentang konser yang akan datang dan penawaran eksklusif.</p>
                <form class="row g-3 justify-content-center">
                    <div class="col-md-8">
                        <input type="email" class="form-control form-control-lg" placeholder="Masukkan alamat email Anda">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-light btn-lg w-100">Berlangganan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> 