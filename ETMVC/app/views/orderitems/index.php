<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h1><?php echo $data['title']; ?></h1>
    <table class="table">
        <thead>
            <tr>
                <th>Ürün Adı</th>
                <th>Miktar</th>
                <th>Fiyat</th>
                <th>Toplam</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['orderItems'] as $item) : ?>
                <tr>
                    <td><?php echo $item->product_name; ?></td>
                    <td><?php echo $item->quantity; ?></td>
                    <td><?php echo $item->price; ?>₺</td>
                    <td><?php echo $item->quantity * $item->price; ?>₺</td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/orderitems/edit/<?php echo $item->id; ?>" class="btn btn-warning">Düzenle</a>
                        <a href="<?php echo URLROOT; ?>/orderitems/delete/<?php echo $item->id; ?>" class="btn btn-danger">Sil</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?php echo URLROOT; ?>/orderitems/add/<?php echo $data['order_id']; ?>" class="btn btn-primary">Yeni Sipariş Kalemi Ekle</a>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
