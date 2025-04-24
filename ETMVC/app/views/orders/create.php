<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Yeni Sipariş Ekle</h1>

    <form action="<?= URLROOT ?>/orders/create" method="POST">
        <div class="mb-3">
            <label for="user_id" class="form-label">Müşteri</label>
            <input type="number" class="form-control" id="user_id" name="user_id" required>
        </div>

        <div class="mb-3">
            <label for="total_amount" class="form-label">Toplam Tutar</label>
            <input type="number" class="form-control" id="total_amount" name="total_amount" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Sipariş Durumu</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending">Beklemede</option>
                <option value="completed">Tamamlandı</option>
                <option value="cancelled">İptal Edildi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="payment_status" class="form-label">Ödeme Durumu</label>
            <select class="form-control" id="payment_status" name="payment_status" required>
                <option value="paid">Ödendi</option>
                <option value="unpaid">Ödenmedi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="shipping_address" class="form-label">Gönderim Adresi</label>
            <input type="text" class="form-control" id="shipping_address" name="shipping_address" required>
        </div>

        <div class="mb-3">
            <label for="shipping_phone" class="form-label">Telefon</label>
            <input type="text" class="form-control" id="shipping_phone" name="shipping_phone" required>
        </div>

        <div class="mb-3">
            <label for="shipping_email" class="form-label">E-posta</label>
            <input type="email" class="form-control" id="shipping_email" name="shipping_email" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notlar</label>
            <textarea class="form-control" id="notes" name="notes"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Siparişi Ekle</button>
    </form>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
