    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-ticket-alt me-2"></i>Ticket Concert</h5>
                    <p class="text-muted">Website penjualan tiket konser terpercaya dengan berbagai pilihan konser terbaik.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>" class="text-muted">Beranda</a></li>
                        <li><a href="<?php echo base_url('concerts'); ?>" class="text-muted">Konser</a></li>
                        <li><a href="<?php echo base_url('about'); ?>" class="text-muted">Tentang Kami</a></li>
                        <li><a href="<?php echo base_url('contact'); ?>" class="text-muted">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Informasi Kontak</h5>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jakarta, Indonesia</li>
                        <li><i class="fas fa-phone me-2"></i>+62 812-3456-7890</li>
                        <li><i class="fas fa-envelope me-2"></i>info@ticketconcert.com</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-muted mb-0">&copy; 2024 Ticket Concert. Semua hak dilindungi.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="<?php echo base_url('terms'); ?>" class="text-muted me-3">Syarat & Ketentuan</a>
                    <a href="<?php echo base_url('privacy'); ?>" class="text-muted">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        // Cart counter update
        function updateCartCounter() {
            $.ajax({
                url: '<?php echo base_url("api/cart-count"); ?>',
                type: 'GET',
                success: function(response) {
                    $('.badge').text(response.count);
                }
            });
        }

        // Update cart counter on page load
        $(document).ready(function() {
            updateCartCounter();
        });
    </script>
</body>
</html> 