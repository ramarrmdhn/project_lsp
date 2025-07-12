<!-- Orders List Page -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-list me-2"></i>Pesanan Saya</h2>
                <a href="<?php echo base_url('concerts'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Beli Tiket Baru
                </a>
            </div>
        </div>
    </div>

    <?php if(empty($orders)): ?>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-ticket-alt fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada pesanan</h4>
                        <p class="text-muted mb-4">Anda belum memiliki pesanan tiket konser.</p>
                        <a href="<?php echo base_url('concerts'); ?>" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Cari Konser
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach($orders as $order): ?>
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-ticket-alt me-2"></i><?php echo $order->concert_title; ?>
                            </h6>
                            <span class="badge bg-<?php 
                                echo $order->status == 'completed' ? 'success' : 
                                    ($order->status == 'pending' ? 'warning' : 
                                    ($order->status == 'cancelled' ? 'danger' : 'info')); 
                            ?>">
                                <?php echo ucfirst($order->status); ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Order ID</small>
                                    <p class="mb-0 fw-bold"><?php echo $order->order_id; ?></p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Tanggal Pesanan</small>
                                    <p class="mb-0"><?php echo date('d/m/Y', strtotime($order->created_at)); ?></p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Total Tiket</small>
                                    <p class="mb-0"><?php echo $order->total_tickets; ?> tiket</p>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Total Harga</small>
                                    <p class="mb-0 fw-bold text-primary">Rp <?php echo number_format($order->total_amount, 0, ',', '.'); ?></p>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <small class="text-muted">Detail Konser</small>
                                <p class="mb-1">
                                    <i class="fas fa-map-marker-alt me-2 text-danger"></i><?php echo $order->venue; ?>
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-calendar me-2 text-primary"></i>
                                    <?php echo date('l, d F Y H:i', strtotime($order->concert_date)); ?>
                                </p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="<?php echo base_url('order/' . $order->id); ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </a>
                                <?php if($order->status == 'completed'): ?>
                                    <a href="<?php echo base_url('order/download/' . $order->id); ?>" class="btn btn-success btn-sm">
                                        <i class="fas fa-download me-1"></i>Download Tiket
                                    </a>
                                <?php elseif($order->status == 'pending'): ?>
                                    <a href="<?php echo base_url('order/payment/' . $order->id); ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-credit-card me-1"></i>Bayar
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div> 