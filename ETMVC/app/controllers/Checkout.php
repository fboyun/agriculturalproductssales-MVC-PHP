<?php
class Checkout extends Controller {
    private $cartModel;

    public function __construct() {
        if(!isLoggedIn()) {
            redirect('users/login');
        }
        
        $this->cartModel = $this->model('CartModel');
    }

    public function index() {
        // Sepetteki toplam tutarı al
        $total = $this->cartModel->getCartTotal($_SESSION['user_id']);
        
        // Sepeti boşalt
        if($this->cartModel->emptyCart($_SESSION['user_id'])) {
            flash('checkout_message', 
                  '<div class="text-center">
                      <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                      <h4 class="mb-3">Ödeme Başarıyla Tamamlandı!</h4>
                      <p class="mb-2">Toplam Ödenen Tutar: <strong>₺' . number_format($total, 2) . '</strong></p>
                      <p class="mb-0">Siparişiniz için teşekkür ederiz.</p>
                   </div>', 
                  'alert alert-success');
        } else {
            flash('checkout_message', 
                  '<div class="text-center">
                      <i class="fas fa-times-circle text-danger fa-3x mb-3"></i>
                      <h4>Ödeme Başarısız!</h4>
                      <p class="mb-0">Lütfen daha sonra tekrar deneyin.</p>
                   </div>', 
                  'alert alert-danger');
        }
        
        redirect('cart');
    }
} 