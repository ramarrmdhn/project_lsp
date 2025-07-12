<!-- Band Trokan Concert Detail -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('concerts'); ?>">Konser</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Band Trokan Live in Concert</li>
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
                            <div class="bg-gradient-primary rounded d-flex align-items-center justify-content-center" 
                                 style="height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <div class="text-center text-white">
                                    <i class="fas fa-music fa-4x mb-3"></i>
                                    <h3 class="mb-0">Band Trokan</h3>
                                    <p class="mb-0">Live in Concert</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="fw-bold mb-3">Band Trokan Live in Concert</h2>
                            <p class="text-muted mb-3">
                                <i class="fas fa-user me-2"></i>Band Trokan
                            </p>
                            <p class="mb-3">
                                <i class="fas fa-map-marker-alt me-2 text-danger"></i>Gelora Bung Karno, Jakarta
                            </p>
                            <p class="mb-3">
                                <i class="fas fa-calendar me-2 text-primary"></i>
                                Sabtu, 15 Juni 2024
                            </p>
                            <p class="mb-3">
                                <i class="fas fa-clock me-2 text-info"></i>
                                19:00 WIB
                            </p>
                            
                            <div class="mb-3">
                                <span class="badge bg-success fs-6">
                                    Aktif
                                </span>
                            </div>
                            
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                500 tiket tersedia
                            </div>
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
                    <p class="mb-3">
                        Nikmati pengalaman musik yang tak terlupakan bersama Band Trokan dalam konser live mereka yang spektakuler! 
                        Konser ini akan menghadirkan lagu-lagu hits terbaik dari Band Trokan dengan aransemen musik yang memukau 
                        dan visual yang menakjubkan.
                    </p>
                    
                    <div class="mt-4">
                        <h6>Setlist yang akan dibawakan:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-music me-2 text-primary"></i>Lagu Hit #1 - Band Trokan</li>
                            <li><i class="fas fa-music me-2 text-primary"></i>Lagu Hit #2 - Band Trokan</li>
                            <li><i class="fas fa-music me-2 text-primary"></i>Lagu Hit #3 - Band Trokan</li>
                            <li><i class="fas fa-music me-2 text-primary"></i>Dan lagu-lagu hits lainnya</li>
                        </ul>
                    </div>
                    
                    <div class="mt-4">
                        <h6>Fasilitas yang tersedia:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check me-2 text-success"></i>Sound system berkualitas tinggi</li>
                            <li><i class="fas fa-check me-2 text-success"></i>Lighting yang spektakuler</li>
                            <li><i class="fas fa-check me-2 text-success"></i>Parkir luas</li>
                            <li><i class="fas fa-check me-2 text-success"></i>Food & beverage</li>
                            <li><i class="fas fa-check me-2 text-success"></i>Merchandise booth</li>
                        </ul>
                    </div>
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
                            <p class="mb-2"><strong>Nama:</strong> Gelora Bung Karno</p>
                            <p class="mb-2"><strong>Kapasitas:</strong> 80,000 orang</p>
                            <p class="mb-0"><strong>Alamat:</strong> Jl. Pintu Satu Senayan, Jakarta Pusat</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Cara Menuju Lokasi</h6>
                            <p class="mb-2"><i class="fas fa-car me-2"></i>Tersedia tempat parkir luas</p>
                            <p class="mb-2"><i class="fas fa-subway me-2"></i>Dekat Stasiun MRT Senayan</p>
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
                    <form id="ticketForm" action="<?php echo base_url('cart/add'); ?>" method="POST">
                        <input type="hidden" name="concert_id" value="1">
                        
                        <!-- VIP Ticket -->
                        <div class="ticket-option mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1">VIP</h6>
                                    <small class="text-muted">Area terdepan, akses eksklusif, merchandise gratis</small>
                                </div>
                                <span class="badge bg-success">100 tersedia</span>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-primary">Rp 1,500,000</span>
                                <div class="input-group" style="width: 120px;">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity('vip')">-</button>
                                    <input type="number" class="form-control form-control-sm text-center" 
                                           name="tickets[vip]" id="quantity_vip" value="0" min="0" max="100">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity('vip')">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Regular Ticket -->
                        <div class="ticket-option mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1">Regular</h6>
                                    <small class="text-muted">Area tengah, pengalaman musik yang nyaman</small>
                                </div>
                                <span class="badge bg-success">300 tersedia</span>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-primary">Rp 800,000</span>
                                <div class="input-group" style="width: 120px;">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity('regular')">-</button>
                                    <input type="number" class="form-control form-control-sm text-center" 
                                           name="tickets[regular]" id="quantity_regular" value="0" min="0" max="300">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity('regular')">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Economy Ticket -->
                        <div class="ticket-option mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1">Economy</h6>
                                    <small class="text-muted">Area belakang, harga terjangkau</small>
                                </div>
                                <span class="badge bg-success">100 tersedia</span>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-primary">Rp 500,000</span>
                                <div class="input-group" style="width: 120px;">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity('economy')">-</button>
                                    <input type="number" class="form-control form-control-sm text-center" 
                                           name="tickets[economy]" id="quantity_economy" value="0" min="0" max="100">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity('economy')">+</button>
                                </div>
                            </div>
                        </div>
                        
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for ticket calculation -->
<script>
const ticketPrices = {
    'vip': 1500000,
    'regular': 800000,
    'economy': 500000
};

function updateTotal() {
    let totalTickets = 0;
    let totalAmount = 0;
    
    Object.keys(ticketPrices).forEach(type => {
        const quantity = parseInt(document.getElementById('quantity_' + type).value) || 0;
        totalTickets += quantity;
        totalAmount += quantity * ticketPrices[type];
    });
    
    document.getElementById('totalTickets').textContent = totalTickets;
    document.getElementById('totalAmount').textContent = 'Rp ' + totalAmount.toLocaleString('id-ID');
    
    const addToCartBtn = document.getElementById('addToCartBtn');
    addToCartBtn.disabled = totalTickets === 0;
}

function increaseQuantity(type) {
    const input = document.getElementById('quantity_' + type);
    const currentValue = parseInt(input.value) || 0;
    const maxValue = parseInt(input.max);
    
    if (currentValue < maxValue) {
        input.value = currentValue + 1;
        updateTotal();
    }
}

function decreaseQuantity(type) {
    const input = document.getElementById('quantity_' + type);
    const currentValue = parseInt(input.value) || 0;
    
    if (currentValue > 0) {
        input.value = currentValue - 1;
        updateTotal();
    }
}

// Add event listeners for quantity inputs
document.addEventListener('DOMContentLoaded', function() {
    Object.keys(ticketPrices).forEach(type => {
        const input = document.getElementById('quantity_' + type);
        input.addEventListener('change', updateTotal);
    });
});
</script> 