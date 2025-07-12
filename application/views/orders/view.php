<!-- Order Detail Page -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('orders'); ?>">Pesanan Saya</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Order Information -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">Order ID:</label>
                                <p class="mb-0"><?php echo $order->order_id; ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Tanggal Pesanan:</label>
                                <p class="mb-0"><?php echo date('l, d F Y H:i', strtotime($order->created_at)); ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Status:</label>
                                <span class="badge bg-<?php 
                                    echo $order->status == 'completed' ? 'success' : 
                                        ($order->status == 'pending' ? 'warning' : 
                                        ($order->status == 'cancelled' ? 'danger' : 'info')); 
                                ?>">
                                    <?php echo ucfirst($order->status); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">Total Tiket:</label>
                                <p class="mb-0"><?php echo $order->total_tickets; ?> tiket</p>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Total Harga:</label>
                                <p class="mb-0 fw-bold text-primary">Rp <?php echo number_format($order->total_amount, 0, ',', '.'); ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Metode Pembayaran:</label>
                                <p class="mb-0"><?php echo ucfirst($order->payment_method ?? 'Transfer Bank'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Concert Information -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-music me-2"></i>Informasi Konser</h5>
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
                            <h5><?php echo $order->concert_title; ?></h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-user me-2"></i><?php echo $order->artist; ?>
                            </p>
                            <p class="text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-2 text-danger"></i><?php echo $order->venue; ?>
                            </p>
                            <p class="text-muted mb-0">
                                <i class="fas fa-calendar me-2 text-primary"></i>
                                <?php echo date('l, d F Y H:i', strtotime($order->concert_date)); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Details -->
            <?php if(isset($order_items) && !empty($order_items)): ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Detail Tiket</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($order_items as $item): ?>
                                        <tr>
                                            <td>
                                                <span class="badge bg-primary"><?php echo ucfirst($item->ticket_category); ?></span>
                                                <small class="text-muted d-block"><?php echo $item->description; ?></small>
                                            </td>
                                            <td><?php echo $item->quantity; ?></td>
                                            <td>Rp <?php echo number_format($item->price, 0, ',', '.'); ?></td>
                                            <td class="fw-bold">Rp <?php echo number_format($item->quantity * $item->price, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Order Actions -->
        <div class="col-lg-4">
            <div class="card shadow sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Aksi Pesanan</h5>
                </div>
                <div class="card-body">
                    <?php if($order->status == 'completed'): ?>
                        <div class="d-grid mb-3">
                            <a href="<?php echo base_url('order/download/' . $order->id); ?>" class="btn btn-success">
                                <i class="fas fa-download me-2"></i>Download Tiket
                            </a>
                        </div>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Pesanan Selesai:</strong> Tiket Anda telah siap untuk didownload.
                        </div>
                    <?php elseif($order->status == 'pending'): ?>
                        <div class="d-grid mb-3">
                            <a href="<?php echo base_url('order/payment/' . $order->id); ?>" class="btn btn-warning">
                                <i class="fas fa-credit-card me-2"></i>Lanjutkan Pembayaran
                            </a>
                        </div>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Menunggu Pembayaran:</strong> Silakan selesaikan pembayaran untuk mengkonfirmasi pesanan.
                        </div>
                    <?php elseif($order->status == 'cancelled'): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-times-circle me-2"></i>
                            <strong>Pesanan Dibatalkan:</strong> Pesanan ini telah dibatalkan.
                        </div>
                    <?php endif; ?>

                    <div class="d-grid">
                        <a href="<?php echo base_url('orders'); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 