<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h1>Sipariş Kalemini Düzenle</h1>
    
    <?php if (!empty($data['errors'])) : ?>
        <div class="alert alert-danger">
            <?php foreach ($data['errors'] as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo URLROOT; ?>/orderitems/edit/<?php echo $data['id']; ?>" method="POST">
        <input type="hidden" name="order_id" value="<?php echo $data['order_id']; ?>">

        <div class="form-group">
            <label for="product_id">Ürün</label>
            <select name="product_id" id="product_id" class="form-control">
                <option value="">Bir ürün seçin</option>
                <?php foreach ($data['products'] as $product) : ?>
                    <option value="<?php echo $product->id; ?>" <?php echo ($product->id == $data['product_id']) ? 'selected' : ''; ?>>
                        <?php echo $product->name; ?> - <?php echo $product->price; ?>₺
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Miktar</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo $data['quantity']; ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Fiyat</label>
            <input type="text" name="price" id="price" class="form-control" value="<?php echo $data['price']; ?>" required>
        </div>

        <button type="submit" class="btn btn-warning">Güncelle</button>
    </form>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
