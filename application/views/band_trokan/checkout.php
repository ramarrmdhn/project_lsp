<!-- Checkout Page for Band Trokan -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('band-trokan'); ?>">Band Trokan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Order Summary -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="bg-gradient-primary rounded d-flex align-items-center justify-content-center" 
                                 style="height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <div class="text-center text-white">
                                    <i class="fas fa-music fa-2x mb-2"></i>
                                    <h6 class="mb-0">Band Trokan</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h5>Band Trokan Live in Concert</h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i>Gelora Bung Karno, Jakarta
                            </p>
                            <p class="text-muted mb-2">
                                <i class="fas fa-calendar me-2"></i>Sabtu, 15 Juni 2024 - 19:00 WIB
                            </p>
                            
                            <div class="mt-3">
                                <h6>Tiket yang dipilih:</h6>
                                <?php 
                                $prices = ['vip' => 1500000, 'regular' => 800000, 'economy' => 500000];
                                $total_amount = 0;
                                foreach($cart_data['tickets'] as $type => $quantity): 
                                    if($quantity > 0):
                                        $price = $prices[$type];
                                        $subtotal = $quantity * $price;
                                        $total_amount += $subtotal;
                                ?>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span><?php echo ucfirst($type); ?> x <?php echo $quantity; ?></span>
                                        <span>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
                                    </div>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Informasi Pembayaran</h5>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open('band-trokan/process_payment'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Metode Pembayaran</h6>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" checked>
                                        <label class="form-check-label" for="bank_transfer">
                                            <i class="fas fa-university me-2"></i>Transfer Bank
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card">
                                        <label class="form-check-label" for="credit_card">
                                            <i class="fas fa-credit-card me-2"></i>Kartu Kredit
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="e_wallet" value="e_wallet">
                                        <label class="form-check-label" for="e_wallet">
                                            <i class="fas fa-mobile-alt me-2"></i>E-Wallet
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Metode Pengiriman Tiket</h6>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="delivery_method" id="email" value="email" checked>
                                        <label class="form-check-label" for="email">
                                            <i class="fas fa-envelope me-2"></i>Email (Gratis)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="delivery_method" id="sms" value="sms">
                                        <label class="form-check-label" for="sms">
                                            <i class="fas fa-sms me-2"></i>SMS (+Rp 5,000)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="delivery_method" id="physical" value="physical">
                                        <label class="form-check-label" for="physical">
                                            <i class="fas fa-ticket-alt me-2"></i>Tiket Fisik (+Rp 10,000)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h6>Informasi Pribadi</h6>
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="full_name" value="<?php echo $this->session->userdata('full_name'); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $this->session->userdata('email'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi Kontak</h6>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" name="phone" value="<?php echo $this->session->userdata('phone'); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="address" rows="3" required><?php echo $this->session->userdata('address'); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-credit-card me-2"></i>Lanjutkan Pembayaran
                            </button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="col-lg-4">
            <div class="card shadow sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Ringkasan Pembayaran</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>Rp <?php echo number_format($total_amount, 0, ',', '.'); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Layanan:</span>
                            <span>Rp 25,000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Pajak:</span>
                            <span>Rp <?php echo number_format($total_amount * 0.1, 0, ',', '.'); ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total:</span>
                            <span class="text-primary">Rp <?php echo number_format($total_amount + 25000 + ($total_amount * 0.1), 0, ',', '.'); ?></span>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Pembayaran Aman:</strong> Informasi pembayaran Anda dienkripsi dan aman.
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Penting:</strong> Pastikan data yang Anda masukkan sudah benar sebelum melanjutkan pembayaran.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 