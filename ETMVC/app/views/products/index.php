<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <!-- Kategoriler -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Kategoriler</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="javascript:void(0)" 
                       class="list-group-item list-group-item-action category-filter <?php echo !isset($_GET['category']) ? 'active' : ''; ?>" 
                       data-category="0">
                        Tüm Ürünler
                    </a>
                    <?php foreach($data['categories'] as $category) : ?>
                        <a href="javascript:void(0)" 
                           class="list-group-item list-group-item-action category-filter <?php echo (isset($_GET['category']) && $_GET['category'] == $category->id) ? 'active' : ''; ?>" 
                           data-category="<?php echo $category->id; ?>">
                            <?php echo $category->name; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Ürünler -->
        <div class="col-md-9">
            <div class="row g-4" id="products-container">
                <?php foreach($data['products'] as $product) : ?>
                    <div class="col-md-4">
                        <div class="card h-100 product-card">
                            <div class="card-img-wrapper">
                                <img src="<?php echo URLROOT; ?>/img/products/<?php echo $product->image; ?>" 
                                     class="card-img-top" 
                                     alt="<?php echo $product->name; ?>">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product->name; ?></h5>
                                <p class="card-text text-success fw-bold mb-3">₺<?php echo number_format($product->price, 2); ?></p>
                                <div class="d-grid gap-2">
                                    <a href="<?php echo URLROOT; ?>/products/show/<?php echo $product->id; ?>" 
                                       class="btn btn-outline-success">
                                        <i class="fas fa-eye"></i> İncele
                                    </a>
                                    <?php if($product->stock > 0) : ?>
                                        <button class="btn btn-success add-to-cart" data-product-id="<?php echo $product->id; ?>">
                                            <i class="fas fa-cart-plus"></i> Sepete Ekle
                                        </button>
                                    <?php else : ?>
                                        <button class="btn btn-secondary" disabled>
                                            <i class="fas fa-times"></i> Stokta Yok
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Kategori filtresi
    $('.category-filter').click(function() {
        var categoryId = $(this).data('category');
        
        // Aktif sınıfını güncelle
        $('.category-filter').removeClass('active');
        $(this).addClass('active');
        
        // Ürünleri filtrele
        $.ajax({
            url: URLROOT + '/products/getProductsByCategory',
            type: 'POST',
            data: {
                category_id: categoryId
            },
            success: function(products) {
                var html = '';
                
                products.forEach(function(product) {
                    html += `
                        <div class="col-md-4">
                            <div class="card h-100 product-card">
                                <div class="card-img-wrapper">
                                    <img src="${URLROOT}/img/products/${product.image}" 
                                         class="card-img-top" 
                                         alt="${product.name}">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">${product.name}</h5>
                                    <p class="card-text text-success fw-bold mb-3">₺${parseFloat(product.price).toFixed(2)}</p>
                                    <div class="d-grid gap-2">
                                        <a href="${URLROOT}/products/show/${product.id}" 
                                           class="btn btn-outline-success">
                                            <i class="fas fa-eye"></i> İncele
                                        </a>
                                        ${product.stock > 0 ? 
                                            `<button class="btn btn-success add-to-cart" data-product-id="${product.id}">
                                                <i class="fas fa-cart-plus"></i> Sepete Ekle
                                            </button>` : 
                                            `<button class="btn btn-secondary" disabled>
                                                <i class="fas fa-times"></i> Stokta Yok
                                            </button>`
                                        }
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                $('#products-container').html(html);
            }
        });
    });
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?> 