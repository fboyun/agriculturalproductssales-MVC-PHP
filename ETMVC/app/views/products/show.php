<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>">Ana Sayfa</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/products">Ürünler</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $data['product']->name; ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Ürün Detayı -->
        <div class="col-md-9">
            <div class="card border-0 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-6">
                        <?php if($data['product']->image) : ?>
                            <img src="<?php echo URLROOT; ?>/public/img/products/<?php echo $data['product']->image; ?>" 
                                 class="img-fluid rounded-start" 
                                 alt="<?php echo $data['product']->name; ?>"
                                 style="height: 400px; width: 100%; object-fit: cover;">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h2 class="card-title mb-3"><?php echo $data['product']->name; ?></h2>
                            <p class="card-text text-muted mb-4"><?php echo $data['product']->description; ?></p>
                            
                            <div class="mb-4">
                                <h3 class="text-success">₺<?php echo number_format($data['product']->price, 2); ?></h3>
                            </div>

                            <?php if($data['product']->stock <= 0) : ?>
                                <div class="alert alert-danger">
                                    <i class="fas fa-times-circle me-2"></i>Bu ürün stokta bulunmamaktadır.
                                </div>
                            <?php elseif($data['product']->stock <= 5) : ?>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-circle me-2"></i>Son <?php echo $data['product']->stock; ?> ürün!
                                </div>
                            <?php else : ?>
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle me-2"></i>Ürün stokta mevcut
                                </div>
                            <?php endif; ?>

                            <?php if(isLoggedIn() && $data['product']->stock > 0) : ?>
                                <div class="d-grid gap-2">
                                    <button type="button" 
                                            class="btn btn-lg btn-success"
                                            onclick="addToCart(<?php echo $data['product']->id; ?>)">
                                        <i class="fas fa-cart-plus me-2"></i>Sepete Ekle
                                    </button>
                                </div>
                            <?php elseif(!isLoggedIn()) : ?>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>Satın almak için lütfen 
                                    <a href="<?php echo URLROOT; ?>/users/login" class="alert-link">giriş yapın</a>.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Benzer Ürünler -->
            <?php if(!empty($data['similar_products'])) : ?>
                <div class="mt-5">
                    <h3 class="mb-4">Benzer Ürünler</h3>
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <?php foreach($data['similar_products'] as $product) : ?>
                            <?php if($product->id != $data['product']->id) : ?>
                                <div class="col">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <?php if($product->image) : ?>
                                            <img src="<?php echo URLROOT; ?>/public/img/products/<?php echo $product->image; ?>" 
                                                 class="card-img-top" 
                                                 alt="<?php echo $product->name; ?>"
                                                 style="height: 150px; object-fit: cover;">
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $product->name; ?></h5>
                                            <p class="card-text text-success fw-bold">₺<?php echo number_format($product->price, 2); ?></p>
                                            <a href="<?php echo URLROOT; ?>/products/show/<?php echo $product->id; ?>" 
                                               class="btn btn-outline-success w-100">
                                                <i class="fas fa-eye me-2"></i>İncele
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sağ Sidebar -->
        <div class="col-md-3">
            <!-- Kargo Bilgisi -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-truck text-success me-2"></i>Kargo Bilgisi
                    </h5>
                    <p class="card-text">
                        <small class="text-muted">
                            Siparişiniz 1-3 iş günü içinde kargoya verilir.
                            Kargo ücreti: ₺20
                        </small>
                    </p>
                </div>
            </div>

            <!-- Güvenli Alışveriş -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-shield-alt text-success me-2"></i>Güvenli Alışveriş
                    </h5>
                    <p class="card-text">
                        <small class="text-muted">
                            256-bit SSL sertifikası ile güvenli alışveriş yapın.
                            7/24 müşteri desteği.
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 