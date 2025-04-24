<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4"><?= $data['title'] ?></h1>
    
    <h3>Sipariş Bilgileri</h3>
    <p><strong>Müşteri Adı:</strong> <?= $data['order']->user_name ?></p>
    <p><strong>Tutar:</strong> <?= $data['order']->total_amount ?> TL</p>
    <p><strong>Durum:</strong> <?= $data['order']->status ?></p>
    <p><strong>Ödeme Durumu:</strong> <?= $data['order']->payment_status ?></p>
    <p><strong>Adres:</strong> <?= $data['order']->shipping_address ?></p>
    <p><strong>Telefon:</strong> <?= $data['order']->shipping_phone ?></p>
    <p><strong>E-posta:</strong> <?= $data['order']->shipping_email ?></p>
    <p><strong>Notlar:</strong> <?= $data['order']->notes ?></p>

    <h3 class="mt-4">Sipariş Kalemleri</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Ürün Adı</th>
                <th>Adet</th>
                <th>Fiyat</th>
                <th>Toplam</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['order_items'] as $item) : ?>
                <tr>
                    <td><?= $item->id ?></td>
                    <td><?= $item->product_name ?></td>
                    <td><?= $item->quantity ?></td>
                    <td><?= $item->price ?> TL</td>
                    <td><?= $item->total_price ?> TL</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= URLROOT ?>/orders" class="btn btn-secondary mt-4">Geri Dön</a>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
