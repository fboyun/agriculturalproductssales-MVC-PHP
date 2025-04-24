<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli - Siparişler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand">Admin Paneli</a>
            <div class="d-flex">
                <a href="<?php echo BASE_URL; ?>/admin/logout" class="btn btn-light">Çıkış Yap</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Siparişler</h4>
            </div>
            <div class="card-body">
                <?php
                // Veritabanından siparişleri getir
                $query = "SELECT o.*, u.name AS user_name FROM orders o LEFT JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC";
                $orders = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

                if (empty($orders)): ?>
                    <div class="alert alert-info">Henüz sipariş bulunmamaktadır.</div>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h5>Sipariş #<?php echo $order['id']; ?></h5>
                                    <div>
                                        <span class="badge bg-<?php echo $order['status'] == 'delivered' ? 'success' : 'warning'; ?>">
                                            <?php echo ucfirst($order['status']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Müşteri Bilgileri</h6>
                                        <hr>
                                        <p><strong>Ad Soyad:</strong> <?php echo isset($order['user_name']) ? $order['user_name'] : 'Bilinmiyor'; ?></p>
                                        <p><strong>Telefon:</strong> <?php echo $order['shipping_phone']; ?></p>
                                        <p><strong>Adres:</strong> <?php echo $order['shipping_address']; ?></p>
                                        <p><strong>Ödeme Durumu:</strong> <?php echo ucfirst($order['payment_status']); ?></p>
                                        <p><strong>Sipariş Tarihi:</strong> <?php echo date('d.m.Y H:i', strtotime($order['created_at'])); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Sipariş Detayları</h6>
                                        <hr>
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Ürün</th>
                                                    <th>Adet</th>
                                                    <th>Fiyat</th>
                                                    <th>Toplam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Siparişe ait ürünleri getir
                                                $query = "SELECT oi.*, p.name AS product_name FROM order_items oi LEFT JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?";
                                                $stmt = $db->prepare($query);
                                                $stmt->execute([$order['id']]);
                                                $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($items as $item): ?>
                                                    <tr>
                                                        <td><?php echo $item['product_name']; ?></td>
                                                        <td><?php echo $item['quantity']; ?></td>
                                                        <td><?php echo number_format($item['price'], 2); ?> TL</td>
                                                        <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?> TL</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="3" class="text-end"><strong>Toplam:</strong></td>
                                                    <td><strong><?php echo number_format($order['total_amount'], 2); ?> TL</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
