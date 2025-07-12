<!-- Payment Success Page -->
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    
                    <h2 class="text-success mb-3">Pembayaran Berhasil!</h2>
                    <p class="text-muted mb-4">
                        Terima kasih telah membeli tiket konser Band Trokan. Pesanan Anda telah diproses dengan sukses.
                    </p>
                    
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle me-2"></i>Order ID: <?php echo $order_id; ?></h6>
                        <p class="mb-0">Simpan Order ID ini untuk referensi Anda.</p>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Detail Konser</h6>
                                </div>
                                <div class="card-body">
                                    <h6>Band Trokan Live in Concert</h6>
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-map-marker-alt me-2"></i>Gelora Bung Karno, Jakarta
                                    </p>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-calendar me-2"></i>Sabtu, 15 Juni 2024 - 19:00 WIB
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="fas fa-envelope me-2"></i>Pengiriman Tiket</h6>
                                </div>
                                <div class="card-body">
                                    <p class="mb-2">Tiket akan dikirim ke:</p>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-envelope me-2"></i><?php echo $this->session->userdata('email'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h6>Langkah Selanjutnya:</h6>
                        <div class="row text-start">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Cek email Anda untuk konfirmasi pembayaran
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Tiket akan dikirim dalam 24 jam
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Simpan tiket dengan baik
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Datang 1 jam sebelum konser
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-5">
                        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary me-3">
                            <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                        </a>
                        <a href="<?php echo base_url('orders'); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>Lihat Pesanan Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 