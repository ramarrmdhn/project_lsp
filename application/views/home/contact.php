<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="text-center mb-4">Hubungi Kami</h1>
                    
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                            </div>
                            <h5>Alamat</h5>
                            <p class="text-muted">Jl. Concert Street No. 123<br>Jakarta, Indonesia</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                <i class="fas fa-phone fa-2x text-success"></i>
                            </div>
                            <h5>Telepon</h5>
                            <p class="text-muted">+62 21 1234 5678<br>+62 812 3456 7890</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="mb-3">
                                <i class="fas fa-envelope fa-2x text-info"></i>
                            </div>
                            <h5>Email</h5>
                            <p class="text-muted">info@concertticket.com<br>support@concertticket.com</p>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Kirim Pesan kepada Kami</h3>
                            <?php if($this->session->flashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= $this->session->flashdata('success') ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if(validation_errors()): ?>
                                <div class="alert alert-danger">
                                    <?= validation_errors() ?>
                                </div>
                            <?php endif; ?>
                            
                            <?= form_open('contact') ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama *</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email *</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subjek *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" value="<?= set_value('subject') ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Pesan *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required><?= set_value('message') ?></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                            <?= form_close() ?>
                        </div>
                        
                        <div class="col-md-4">
                            <h3>Jam Operasional</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Senin - Jumat:</strong><br>09:00 - 18:00</li>
                                <li class="mb-2"><strong>Sabtu:</strong><br>10:00 - 16:00</li>
                                <li class="mb-2"><strong>Minggu:</strong><br>Tutup</li>
                            </ul>
                            
                            <h3 class="mt-4">Ikuti Kami</h3>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary"><i class="fab fa-facebook"></i></a>
                                <a href="#" class="btn btn-outline-info"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn btn-outline-danger"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="btn btn-outline-dark"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 