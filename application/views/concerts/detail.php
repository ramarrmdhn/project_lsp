<!-- Concert Detail Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('concerts'); ?>">Konser</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $concert->title; ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Concert Image and Info -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if($concert->image): ?>
                                <img src="<?php echo base_url('uploads/concerts/' . $concert->image); ?>" 
                                     class="img-fluid rounded" alt="<?php echo $concert->title; ?>">
                            <?php else: ?>
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="height: 300px;">
                                    <i class="fas fa-music fa-4x text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <h2 class="fw-bold mb-3"><?php echo $concert->title; ?></h2>
                            <p class="text-muted mb-3">
                                <i class="fas fa-user me-2"></i><?php echo $concert->artist; ?>
                            </p>
                            <p class="mb-3">
                                <i class="fas fa-map-marker-alt me-2 text-danger"></i><?php echo $concert->venue; ?>
                            </p>
                            <p class="mb-3">
                                <i class="fas fa-calendar me-2 text-primary"></i>
                                <?php echo date('l, d F Y', strtotime($concert->date_time)); ?>
                            </p>
                            <p class="mb-3">
                                <i class="fas fa-clock me-2 text-info"></i>
                                <?php echo date('H:i', strtotime($concert->date_time)); ?> WIB
                            </p>
                            
                            <div class="mb-3">
                                <span class="badge bg-<?php 
                                    echo $concert->status == 'upcoming' ? 'primary' : 
                                        ($concert->status == 'active' ? 'success' : 'secondary'); 
                                ?> fs-6">
                                    <?php echo ucfirst($concert->status); ?>
                                </span>
                            </div>
                            
                            <?php if($concert->available_tickets > 0): ?>
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <?php echo $concert->available_tickets; ?> tiket tersedia
                                </div>
                            <?php else: ?>
                                <div class="alert alert-danger">
                                    <i class="fas fa-times-circle me-2"></i>
                                    Habis terjual
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Concert Description -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Tentang Konser Ini</h5>
                </div>
                <div class="card-body">
                    <p class="mb-3"><?php echo $concert->description; ?></p>
                    
                    <?php if($concert->additional_info): ?>
                        <div class="mt-4">
                            <h6>Informasi Tambahan:</h6>
                            <p class="mb-0"><?php echo $concert->additional_info; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Venue Information -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Informasi Venue</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Detail Venue</h6>
                            <p class="mb-2"><strong>Nama:</strong> <?php echo $concert->venue; ?></p>
                            <p class="mb-2"><strong>Kapasitas:</strong> <?php echo number_format($concert->capacity, 0, ',', '.'); ?> orang</p>
                            <p class="mb-0"><strong>Alamat:</strong> <?php echo $concert->venue_address ?? 'Alamat tidak tersedia'; ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Cara Menuju Lokasi</h6>
                            <p class="mb-2"><i class="fas fa-car me-2"></i>Tersedia tempat parkir</p>
                            <p class="mb-2"><i class="fas fa-subway me-2"></i>Dekat transportasi umum</p>
                            <p class="mb-0"><i class="fas fa-wheelchair me-2"></i>Akses kursi roda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ticket Selection -->
        <div class="col-lg-4">
            <div class="card shadow sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Pilih Tiket</h5>
                </div>
                <div class="card-body">
                    <?php if($concert->status == 'active' && $concert->available_tickets > 0): ?>
                        <form id="ticketForm" action="<?php echo base_url('cart/add'); ?>" method="POST">
                            <input type="hidden" name="concert_id" value="<?php echo $concert->id; ?>">
                            
                            <?php if(isset($tickets) && !empty($tickets)): ?>
                                <?php foreach($tickets as $ticket): ?>
                                    <div class="ticket-option mb-3 p-3 border rounded">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="mb-1"><?php echo $ticket->category; ?></h6>
                                                <small class="text-muted"><?php echo $ticket->description; ?></small>
                                            </div>
                                            <span class="badge bg-<?php echo $ticket->available > 0 ? 'success' : 'danger'; ?>">
                                                <?php echo $ticket->available > 0 ? $ticket->available . ' tersedia' : 'Habis terjual'; ?>
                                            </span>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold text-primary">Rp <?php echo number_format($ticket->price, 0, ',', '.'); ?></span>
                                            <?php if($ticket->available > 0): ?>
                                                <div class="input-group" style="width: 120px;">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity(<?php echo $ticket->id; ?>)">-</button>
                                                    <input type="number" class="form-control form-control-sm text-center" 
                                                           name="tickets[<?php echo $ticket->id; ?>]" 
                                                           id="quantity_<?php echo $ticket->id; ?>" 
                                                           value="0" min="0" max="<?php echo $ticket->available; ?>">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity(<?php echo $ticket->id; ?>)">+</button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <?php if($ticket->available <= 0): ?>
                                            <div class="text-center">
                                                <span class="text-danger">Habis terjual</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                                
                                <div class="border-top pt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Total Tiket:</span>
                                        <span id="totalTickets">0</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Total Harga:</span>
                                        <span id="totalAmount" class="fw-bold text-primary">Rp 0</span>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary" id="addToCartBtn" disabled>
                                            <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                                        </button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">Tidak ada tiket tersedia</h6>
                                    <p class="text-muted small">Tiket akan tersedia segera</p>
                                </div>
                            <?php endif; ?>
                        </form>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <?php if($concert->status != 'active'): ?>
                                <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">Tiket belum tersedia</h6>
                                <p class="text-muted small">Tiket akan tersedia ketika konser aktif</p>
                            <?php else: ?>
                                <i class="fas fa-times-circle fa-3x text-danger mb-3"></i>
                                <h6 class="text-danger">Habis terjual</h6>
                                <p class="text-muted small">Semua tiket telah terjual</p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar Concerts -->
    <?php if(isset($similar_concerts) && !empty($similar_concerts)): ?>
        <div class="row mt-5">
            <div class="col-12">
                <h4 class="mb-4">Similar Concerts</h4>
                <div class="row">
                    <?php foreach($similar_concerts as $similar): ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card concert-card h-100">
                                <?php if($similar->image): ?>
                                    <img src="<?php echo base_url('uploads/concerts/' . $similar->image); ?>" class="card-img-top" alt="<?php echo $similar->title; ?>">
                                <?php else: ?>
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-music fa-3x text-muted"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h6 class="card-title fw-bold"><?php echo $similar->title; ?></h6>
                                    <p class="card-text text-muted small">
                                        <i class="fas fa-user me-1"></i><?php echo $similar->artist; ?>
                                    </p>
                                    <p class="card-text small">
                                        <i class="fas fa-calendar me-1 text-primary"></i>
                                        <?php echo date('d M Y', strtotime($similar->date_time)); ?>
                                    </p>
                                    <div class="d-grid">
                                        <a href="<?php echo base_url('concert/' . $similar->id); ?>" class="btn btn-outline-primary btn-sm">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
// Ticket quantity management
function increaseQuantity(ticketId) {
    const input = document.getElementById('quantity_' + ticketId);
    const max = parseInt(input.getAttribute('max'));
    const currentValue = parseInt(input.value) || 0;
    
    if (currentValue < max) {
        input.value = currentValue + 1;
        updateTotals();
    }
}

function decreaseQuantity(ticketId) {
    const input = document.getElementById('quantity_' + ticketId);
    const currentValue = parseInt(input.value) || 0;
    
    if (currentValue > 0) {
        input.value = currentValue - 1;
        updateTotals();
    }
}

function updateTotals() {
    let totalTickets = 0;
    let totalAmount = 0;
    
    // Get all quantity inputs
    const quantityInputs = document.querySelectorAll('input[name^="tickets["]');
    
    quantityInputs.forEach(input => {
        const quantity = parseInt(input.value) || 0;
        const ticketId = input.name.match(/\[(\d+)\]/)[1];
        const ticketOption = input.closest('.ticket-option');
        const priceText = ticketOption.querySelector('.text-primary').textContent;
        const price = parseInt(priceText.replace(/[^\d]/g, ''));
        
        totalTickets += quantity;
        totalAmount += quantity * price;
    });
    
    document.getElementById('totalTickets').textContent = totalTickets;
    document.getElementById('totalAmount').textContent = 'Rp ' + totalAmount.toLocaleString('id-ID');
    
    // Enable/disable add to cart button
    const addToCartBtn = document.getElementById('addToCartBtn');
    addToCartBtn.disabled = totalTickets === 0;
}

// Add event listeners to quantity inputs
document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('input[name^="tickets["]');
    quantityInputs.forEach(input => {
        input.addEventListener('change', updateTotals);
    });
});
</script> 