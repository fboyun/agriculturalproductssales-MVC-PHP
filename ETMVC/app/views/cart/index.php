<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Sepetim</h1>

    <?php flash('checkout_message'); ?>

    <?php if(empty($data['cart_items'])) : ?>
        <div class="alert alert-info">
            <i class="fas fa-shopping-cart me-2"></i>
            Sepetinizde ürün bulunmamaktadır.
            <a href="<?php echo URLROOT; ?>/products" class="alert-link">Alışverişe başlayın</a>
        </div>
    <?php else : ?>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <?php foreach($data['cart_items'] as $item) : ?>
                            <div class="cart-item mb-3 pb-3 border-bottom">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="<?php echo URLROOT; ?>/img/products/<?php echo $item->image; ?>" 
                                             alt="<?php echo $item->name; ?>" 
                                             class="img-fluid rounded">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="mb-1"><?php echo $item->name; ?></h5>
                                        <p class="text-muted mb-0">Birim Fiyat: ₺<?php echo number_format($item->price, 2); ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary update-quantity" 
                                                    data-product-id="<?php echo $item->product_id; ?>" 
                                                    data-action="decrease">-</button>
                                            <input type="number" class="form-control text-center quantity-input" 
                                                   value="<?php echo $item->quantity; ?>" 
                                                   min="1" 
                                                   data-product-id="<?php echo $item->product_id; ?>">
                                            <button class="btn btn-outline-secondary update-quantity" 
                                                    data-product-id="<?php echo $item->product_id; ?>" 
                                                    data-action="increase">+</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p class="fw-bold mb-0">₺<?php echo number_format($item->total_price, 2); ?></p>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-link text-danger remove-from-cart" 
                                                data-product-id="<?php echo $item->product_id; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Sipariş Özeti</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Ara Toplam</span>
                            <span class="fw-bold">₺<?php echo number_format($data['total'], 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Kargo</span>
                            <span class="text-success">Ücretsiz</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Toplam</span>
                            <span class="fw-bold">₺<?php echo number_format($data['total'], 2); ?></span>
                        </div>
                        <a href="<?php echo URLROOT; ?>/orders/show" class="btn btn-success w-100">
                            Ödemeye Geç
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
$(document).ready(function() {
    // Miktar güncelleme
    $('.update-quantity').click(function() {
        var productId = $(this).data('product-id');
        var action = $(this).data('action');
        var input = $('.quantity-input[data-product-id="' + productId + '"]');
        var currentQuantity = parseInt(input.val());
        
        if(action === 'increase') {
            input.val(currentQuantity + 1);
        } else if(action === 'decrease' && currentQuantity > 1) {
            input.val(currentQuantity - 1);
        }
        
        updateCart(productId, input.val());
    });

    // Manuel miktar girişi
    $('.quantity-input').change(function() {
        var productId = $(this).data('product-id');
        var quantity = $(this).val();
        
        if(quantity < 1) {
            $(this).val(1);
            quantity = 1;
        }
        
        updateCart(productId, quantity);
    });

    // Sepetten kaldır
    $('.remove-from-cart').click(function() {
        var productId = $(this).data('product-id');
        
        $.ajax({
            url: URLROOT + '/cart/remove',
            type: 'POST',
            data: {
                product_id: productId
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            }
        });
    });

    // Sepeti güncelle
    function updateCart(productId, quantity) {
        $.ajax({
            url: URLROOT + '/cart/update',
            type: 'POST',
            data: {
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            }
        });
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?> 