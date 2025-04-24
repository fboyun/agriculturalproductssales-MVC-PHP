<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>">Ana Sayfa</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/products">Ürünler</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $data['category']->name; ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Kategori Başlığı -->
        <div class="col-md-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <?php if($data['category']->image) : ?>
                            <img src="<?php echo URLROOT; ?>/public/img/categories/<?php echo $data['category']->image; ?>" 
                                 alt="<?php echo $data['category']->name; ?>"
                                 class="rounded me-3"
                                 style="width: 64px; height: 64px; object-fit: cover;">
                        <?php endif; ?>
                        <div>
                            <h1 class="h3 mb-2"><?php echo $data['category']->name; ?></h1>
                            <p class="text-muted mb-0"><?php echo $data['category']->description; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ürünler -->
        <div class="col-md-12">
            <?php if(empty($data['products'])) : ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Bu kategoride henüz ürün bulunmamaktadır.
                </div>
            <?php else : ?>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php foreach($data['products'] as $product) : ?>
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm">
                                <?php if($product->image) : ?>
                                    <img src="<?php echo URLROOT; ?>/public/img/products/<?php echo $product->image; ?>" 
                                         class="card-img-top" 
                                         alt="<?php echo $product->name; ?>"
                                         style="height: 200px; object-fit: cover;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product->name; ?></h5>
                                    <p class="card-text text-muted">
                                        <?php echo substr($product->description, 0, 100); ?>...
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="text-success mb-0">₺<?php echo number_format($product->price, 2); ?></h4>
                                        <div class="btn-group">
                                            <a href="<?php echo URLROOT; ?>/products/show/<?php echo $product->id; ?>" 
                                               class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if(isLoggedIn()) : ?>
                                                <button type="button" 
                                                        class="btn btn-sm btn-success"
                                                        onclick="addToCart(<?php echo $product->id; ?>)">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if($product->stock <= 0) : ?>
                                    <div class="card-footer bg-danger text-white text-center">
                                        <small>Stokta Yok</small>
                                    </div>
                                <?php elseif($product->stock <= 5) : ?>
                                    <div class="card-footer bg-warning text-dark text-center">
                                        <small>Son <?php echo $product->stock; ?> Ürün</small>
                                    </div>
                                <?php else : ?>
                                    <div class="card-footer bg-success text-white text-center">
                                        <small>Stokta Var</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 