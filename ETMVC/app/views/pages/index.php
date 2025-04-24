<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Banner Section -->
<div class="banner position-relative">
    <img src="<?php echo URLROOT; ?>/img/banners/fresh-products.jpg" alt="Taze Ürünler" class="w-100" style="height: 600px; object-fit: cover;">
    <div class="banner-content position-absolute top-50 start-50 translate-middle text-center text-white">
        <h1 class="display-4 fw-bold mb-4">Taze ve Doğal Ürünler</h1>
        <p class="lead mb-4">Çiftlikten sofranıza en taze tarım ürünleri</p>
        <a href="<?php echo URLROOT; ?>/products" class="btn btn-success btn-lg px-5 py-3">Ürünleri Keşfet</a>
    </div>
</div>

<!-- Why Choose Us -->
<section class="why-choose-us py-5 mb-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="display-6 fw-bold">Neden Bizi Tercih Etmelisiniz?</h2>
            <div class="section-divider"></div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-truck-fast fa-3x text-success"></i>
                    </div>
                    <h4 class="mb-3">Hızlı Teslimat</h4>
                    <p class="text-muted mb-0">Siparişleriniz aynı gün içinde hazırlanır ve en kısa sürede teslim edilir.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-leaf fa-3x text-success"></i>
                    </div>
                    <h4 class="mb-3">Taze Ürünler</h4>
                    <p class="text-muted mb-0">Tüm ürünlerimiz günlük olarak temin edilir ve tazeliği garanti edilir.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-hand-holding-dollar fa-3x text-success"></i>
                    </div>
                    <h4 class="mb-3">Uygun Fiyatlar</h4>
                    <p class="text-muted mb-0">Aracısız temin sayesinde en uygun fiyatları sunuyoruz.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?> 