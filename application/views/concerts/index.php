<!-- Page Header -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Konser</h1>
                    <p class="text-muted mb-0">Temukan konser menakjubkan dan pesan tiket Anda</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="<?php echo base_url('concerts'); ?>">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" name="search" 
                                           placeholder="Cari konser, artis, venue..." 
                                           value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="upcoming" <?php echo (isset($_GET['status']) && $_GET['status'] == 'upcoming') ? 'selected' : ''; ?>>Akan Datang</option>
                                    <option value="active" <?php echo (isset($_GET['status']) && $_GET['status'] == 'active') ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="completed" <?php echo (isset($_GET['status']) && $_GET['status'] == 'completed') ? 'selected' : ''; ?>>Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="sort">
                                    <option value="date_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'date_asc') ? 'selected' : ''; ?>>Tanggal (Terlama)</option>
                                    <option value="date_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'date_desc') ? 'selected' : ''; ?>>Tanggal (Terbaru)</option>
                                    <option value="price_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : ''; ?>>Harga (Rendah ke Tinggi)</option>
                                    <option value="price_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : ''; ?>>Harga (Tinggi ke Rendah)</option>
                                    <option value="name_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_asc') ? 'selected' : ''; ?>>Nama (A-Z)</option>
                                    <option value="name_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_desc') ? 'selected' : ''; ?>>Nama (Z-A)</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Info -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0">
                    Menampilkan <?php echo isset($total_results) ? $total_results : 0; ?> konser
                    <?php if(isset($_GET['search']) && $_GET['search']): ?>
                        untuk "<strong><?php echo htmlspecialchars($_GET['search']); ?></strong>"
                    <?php endif; ?>
                </p>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active" id="gridView">
                        <i class="fas fa-th"></i>
                    </button>
                    <button type="button" class="btn btn-outline-primary" id="listView">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Concerts Grid -->
    <div class="row" id="concertsGrid">
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
                            <p class="card-text">
                                <i class="fas fa-ticket-alt me-1 text-success"></i>
                                Starting from Rp <?php echo number_format($concert->min_price, 0, ',', '.'); ?>
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-<?php 
                                    echo $concert->status == 'upcoming' ? 'primary' : 
                                        ($concert->status == 'active' ? 'success' : 'secondary'); 
                                ?>">
                                    <?php echo ucfirst($concert->status); ?>
                                </span>
                                <?php if($concert->available_tickets > 0): ?>
                                                                    <small class="text-success">
                                    <i class="fas fa-check-circle me-1"></i><?php echo $concert->available_tickets; ?> tiket tersedia
                                </small>
                            <?php else: ?>
                                <small class="text-danger">
                                    <i class="fas fa-times-circle me-1"></i>Habis terjual
                                </small>
                                <?php endif; ?>
                            </div>
                            
                            <div class="d-grid">
                                <a href="<?php echo base_url('concert/' . $concert->id); ?>" class="btn btn-primary">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-music fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Tidak ada konser ditemukan</h4>
                    <p class="text-muted">Coba sesuaikan kriteria pencarian atau periksa kembali nanti untuk konser baru.</p>
                    <a href="<?php echo base_url('concerts'); ?>" class="btn btn-primary">
                        <i class="fas fa-refresh me-2"></i>Hapus Filter
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Concerts List (Hidden by default) -->
    <div class="row d-none" id="concertsList">
        <?php if(isset($concerts) && !empty($concerts)): ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Concert</th>
                                        <th>Artist</th>
                                        <th>Venue</th>
                                        <th>Date & Time</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($concerts as $concert): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <?php if($concert->image): ?>
                                                        <img src="<?php echo base_url('uploads/concerts/' . $concert->image); ?>" 
                                                             class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                    <?php else: ?>
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" 
                                                             style="width: 50px; height: 50px;">
                                                            <i class="fas fa-music text-muted"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div>
                                                        <h6 class="mb-0"><?php echo $concert->title; ?></h6>
                                                        <small class="text-muted"><?php echo $concert->description; ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $concert->artist; ?></td>
                                            <td><?php echo $concert->venue; ?></td>
                                            <td><?php echo date('d M Y H:i', strtotime($concert->date_time)); ?></td>
                                            <td>Rp <?php echo number_format($concert->min_price, 0, ',', '.'); ?></td>
                                            <td>
                                                <span class="badge bg-<?php 
                                                    echo $concert->status == 'upcoming' ? 'primary' : 
                                                        ($concert->status == 'active' ? 'success' : 'secondary'); 
                                                ?>">
                                                    <?php echo ucfirst($concert->status); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('concert/' . $concert->id); ?>" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye me-1"></i>View
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if(isset($pagination)): ?>
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Concerts pagination">
                    <?php echo $pagination; ?>
                </nav>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Advanced Filters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="<?php echo base_url('concerts'); ?>">
                    <div class="mb-3">
                        <label class="form-label">Date Range</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="date" class="form-control" name="date_from" 
                                       value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : ''; ?>">
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control" name="date_to" 
                                       value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Price Range</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control" name="price_min" placeholder="Min Price" 
                                       value="<?php echo isset($_GET['price_min']) ? $_GET['price_min'] : ''; ?>">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" name="price_max" placeholder="Max Price" 
                                       value="<?php echo isset($_GET['price_max']) ? $_GET['price_max'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Venue</label>
                        <input type="text" class="form-control" name="venue" placeholder="Search by venue" 
                               value="<?php echo isset($_GET['venue']) ? $_GET['venue'] : ''; ?>">
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <a href="<?php echo base_url('concerts'); ?>" class="btn btn-outline-secondary">Clear All</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// View toggle functionality
document.getElementById('gridView').addEventListener('click', function() {
    document.getElementById('concertsGrid').classList.remove('d-none');
    document.getElementById('concertsList').classList.add('d-none');
    this.classList.add('active');
    document.getElementById('listView').classList.remove('active');
});

document.getElementById('listView').addEventListener('click', function() {
    document.getElementById('concertsGrid').classList.add('d-none');
    document.getElementById('concertsList').classList.remove('d-none');
    this.classList.add('active');
    document.getElementById('gridView').classList.remove('active');
});
</script> 