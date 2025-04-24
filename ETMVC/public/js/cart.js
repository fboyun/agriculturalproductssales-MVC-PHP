$(document).ready(function () {
    // Sepete ekle
    $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var quantity = 1;

        $.ajax({
            url: URLROOT + '/cart/add',
            type: 'POST',
            data: {
                product_id: productId,
                quantity: quantity
            },
            success: function (response) {
                if (response.success) {
                    // Sepet sayacını güncelle
                    $('.cart-count').text(response.cartCount);

                    // Başarılı mesajı göster
                    alert('Ürün sepete eklendi');
                } else {
                    // Hata mesajı göster
                    alert(response.message || 'Bir hata oluştu');
                }
            },
            error: function () {
                alert('Bir hata oluştu');
            }
        });
    });

    // Sayfa yüklendiğinde sepet sayısını güncelle
    function updateCartCount() {
        $.ajax({
            url: URLROOT + '/cart/getCount',
            type: 'GET',
            success: function (response) {
                $('.cart-count').text(response.count);
            }
        });
    }

    // Sayfa yüklendiğinde sepet sayısını güncelle
    updateCartCount();
}); 