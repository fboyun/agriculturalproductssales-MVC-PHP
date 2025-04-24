<div class="container py-5">
    <h1 class="mb-4">Siparişlerim</h1>

    <?php if(empty($data['orders'])): ?>
        <div class="text-center py-5">
            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
            <h3>Henüz Siparişiniz Bulunmuyor</h3>
            <p class="text-muted">Alışverişe başlamak için ürünleri inceleyebilirsiniz.</p>
            <a href="<?= BASE_URL ?>/product" class="btn btn-success">
                <i class="fas fa-shopping-cart me-2"></i> Alışverişe Başla
            </a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach($data['orders'] as $order): ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">
                                    Sipariş #<?= $order['id'] ?>
                                </h5>
                                <span class="badge bg-<?= getStatusBadgeClass($order['status']) ?>">
                                    <?= $order['status'] ?>
                                </span>
                            </div>
                            
                            <div class="mb-3">
                                <small class="text-muted">Sipariş Tarihi</small>
                                <div><?= date('d.m.Y H:i', strtotime($order['created_at'])) ?></div>
                            </div>
                            
                            <div class="mb-3">
                                <small class="text-muted">Toplam Tutar</small>
                                <div class="text-success fw-bold">
                                    <?= number_format($order['total_amount'], 2) ?> ₺
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <small class="text-muted">Teslimat Adresi</small>
                                <div><?= $order['address'] ?></div>
                            </div>
                            
                            <a href="<?= BASE_URL ?>/orders/detail/<?= $order['id'] ?>" 
                               class="btn btn-outline-success w-100">
                                <i class="fas fa-eye me-2"></i> Sipariş Detayı
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php
function getStatusBadgeClass($status) {
    switch($status) {
        case 'Beklemede': return 'warning';
        case 'Onaylandı': return 'info';
        case 'Hazırlanıyor': return 'primary';
        case 'Kargoda': return 'success';
        case 'Tamamlandı': return 'success';
        case 'İptal Edildi': return 'danger';
        default: return 'secondary';
    }
}
?> 