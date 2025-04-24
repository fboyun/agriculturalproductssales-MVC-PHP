<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h1>Yeni Sipariş Kalemi Ekle</h1>
    
    <?php if (!empty($data['errors'])) : ?>
        <div class="alert alert-danger">
            <?php foreach ($data['errors'] as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo URLROOT; ?>/orderitems/add/<?php echo $data['order_id']; ?>" method="POST">
        <div class="form-group">
            <label for="product_id">Ürün</label>
            <select name="product_id" id="product_id" class="form-control">
                <option value="">Bir ürün seçin</option>
                <?php foreach ($data['products'] as $product) : ?>
                    <option value="<?php echo $product->id; ?>"><?php echo $product->name; ?> - <?php echo $product->price; ?>₺</option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="quantity">Miktar</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Fiyat</label>
            <input type="text" name="price" id="price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Ekle</button>
    </form>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
