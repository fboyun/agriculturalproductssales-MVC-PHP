<?php

class OrderItems extends Controller {
    private $orderItemModel;
    private $productModel;

    public function __construct() {
        $this->orderItemModel = $this->model('OrderItem');
        $this->productModel = $this->model('Product');
    }

    // Sipariş kalemlerini listele
    public function index($orderId) {
        $orderItems = $this->orderItemModel->getOrderItemsByOrderId($orderId);
        
        $data = [
            'title' => 'Sipariş Kalemleri',
            'orderItems' => $orderItems
        ];

        $this->view('orderitems/index', $data);
    }

    // Yeni sipariş kalemi ekle
    public function add($orderId) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'order_id' => $orderId,
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['price'],
                'errors' => []
            ];

            // Ürün miktarını kontrol et
            if (empty($data['product_id']) || empty($data['quantity']) || empty($data['price'])) {
                $data['errors'][] = 'Tüm alanlar doldurulmalıdır.';
            }

            // Hata yoksa sipariş kalemini ekle
            if (empty($data['errors'])) {
                if ($this->orderItemModel->addOrderItem($data)) {
                    redirect('orders/show/' . $orderId);
                } else {
                    $data['errors'][] = 'Sipariş kalemi eklenemedi.';
                }
            }

            $this->view('orderitems/add', $data);
        }
    }

    // Sipariş kalemini sil
    public function delete($id) {
        if ($this->orderItemModel->deleteOrderItem($id)) {
            redirect('orders');
        } else {
            die('Bir hata oluştu.');
        }
    }

    // Sipariş kalemi düzenle
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'order_id' => $_POST['order_id'],
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['price'],
                'errors' => []
            ];

            // Hata kontrolü
            if (empty($data['product_id']) || empty($data['quantity']) || empty($data['price'])) {
                $data['errors'][] = 'Tüm alanlar doldurulmalıdır.';
            }

            // Hata yoksa güncellemeyi yap
            if (empty($data['errors'])) {
                if ($this->orderItemModel->updateOrderItem($data)) {
                    redirect('orders/show/' . $data['order_id']);
                } else {
                    $data['errors'][] = 'Sipariş kalemi güncellenemedi.';
                }
            }

            $this->view('orderitems/edit', $data);
        }
    }
}
