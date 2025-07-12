<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Find Your Perfect Concert Experience</h1>
                <p class="lead mb-4">Discover and book tickets for the best concerts in Indonesia. From international superstars to local favorites, we have it all.</p>
                <div class="d-flex gap-3">
                    <a href="<?php echo base_url('concerts'); ?>" class="btn btn-light btn-lg">
                        <i class="fas fa-search me-2"></i>Browse Concerts
                    </a>
                    <?php if(!$this->session->userdata('user_id')): ?>
                        <a href="<?php echo base_url('register'); ?>" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Join Now
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

<!-- Featured Concerts -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2 class="fw-bold">Featured Concerts</h2>
                <p class="text-muted">Don't miss out on these amazing upcoming concerts</p>
            </div>
            <div class="col-lg-4 text-end">
                <a href="<?php echo base_url('concerts'); ?>" class="btn btn-outline-primary">View All Concerts</a>
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
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-music fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No concerts available at the moment</h4>
                    <p class="text-muted">Check back later for upcoming concerts!</p>
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
                <h2 class="fw-bold">Popular Concerts</h2>
                <p class="text-muted">Most booked concerts by our users</p>
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
                                    <i class="fas fa-fire me-1"></i>Popular
                                </span>
                                <a href="<?php echo base_url('concert/' . $concert->id); ?>" class="btn btn-primary btn-sm">
                                    View Details
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
                <h2 class="fw-bold">Why Choose Ticket Concert?</h2>
                <p class="text-muted">We provide the best concert ticket booking experience</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt fa-2x text-primary"></i>
                    </div>
                    <h5>Secure Booking</h5>
                    <p class="text-muted">Safe and secure payment processing with multiple payment options.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-ticket-alt fa-2x text-success"></i>
                    </div>
                    <h5>Instant Tickets</h5>
                    <p class="text-muted">Get your tickets instantly after payment confirmation.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-headset fa-2x text-warning"></i>
                    </div>
                    <h5>24/7 Support</h5>
                    <p class="text-muted">Round the clock customer support to help you with any issues.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-mobile-alt fa-2x text-info"></i>
                    </div>
                    <h5>Mobile Friendly</h5>
                    <p class="text-muted">Book tickets easily from your mobile device anywhere, anytime.</p>
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
                <h3 class="fw-bold mb-3">Stay Updated</h3>
                <p class="mb-4">Subscribe to our newsletter to get the latest updates on upcoming concerts and exclusive offers.</p>
                <form class="row g-3 justify-content-center">
                    <div class="col-md-8">
                        <input type="email" class="form-control form-control-lg" placeholder="Enter your email address">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-light btn-lg w-100">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> 