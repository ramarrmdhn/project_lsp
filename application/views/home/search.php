<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="text-center mb-4">Hasil Pencarian</h1>
                    
                    <?php if(isset($keyword) && $keyword): ?>
                        <div class="mb-4">
                            <h3>Hasil Pencarian untuk: "<?= htmlspecialchars($keyword) ?>"</h3>
                            <p class="text-muted">Ditemukan <?= count($concerts) ?> konser</p>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(empty($concerts)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4>Tidak ada konser ditemukan</h4>
                            <p class="text-muted">Coba sesuaikan kata kunci pencarian atau jelajahi semua konser yang tersedia.</p>
                            <a href="<?= base_url('concerts') ?>" class="btn btn-primary">Jelajahi Semua Konser</a>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach($concerts as $concert): ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100">
                                        <?php if($concert->image): ?>
                                            <img src="<?= base_url('uploads/concerts/' . $concert->image) ?>" class="card-img-top" alt="<?= htmlspecialchars($concert->title) ?>" style="height: 200px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                <i class="fas fa-music fa-3x text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($concert->title) ?></h5>
                                            <p class="card-text text-muted"><?= htmlspecialchars($concert->artist) ?></p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($concert->venue) ?><br>
                                                    <i class="fas fa-calendar"></i> <?= date('d M Y H:i', strtotime($concert->concert_date)) ?>
                                                </small>
                                            </p>
                                            <p class="card-text">
                                                <strong class="text-primary">Rp <?= number_format($concert->ticket_price, 0, ',', '.') ?></strong>
                                            </p>
                                        </div>
                                        
                                        <div class="card-footer bg-transparent">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-<?= $concert->status == 'upcoming' ? 'success' : ($concert->status == 'ongoing' ? 'warning' : 'secondary') ?>">
                                                    <?= ucfirst($concert->status) ?>
                                                </span>
                                                <a href="<?= base_url('concert/' . $concert->id) ?>" class="btn btn-primary btn-sm">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="text-center mt-4">
                        <a href="<?= base_url('concerts') ?>" class="btn btn-outline-primary">Lihat Semua Konser</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 