<?php

class Orders extends Controller {
    private $orderModel;
    private $orderItemModel;

    public function __construct() {
        $this->orderModel = $this->model('Order');
        $this->orderItemModel = $this->model('OrderItem');
    }

    // Siparişleri listele
    public function index() {
        $orders = $this->orderModel->getAllOrders();
        $data = [
            'title' => 'Siparişler',
            'orders' => $orders
        ];

        $this->view('orders/index', $data);
    }

    // Sipariş detayını göster
    public function show($id) {
        $order = $this->orderModel->getOrderById($id);
        $orderItems = $this->orderItemModel->getOrderItemsByOrderId($id);

        if (!$order) {
            redirect('orders');
        }

        $data = [
            'title' => 'Sipariş Detayı',
            'order' => $order,
            'order_items' => $orderItems
        ];

        $this->view('orders/show', $data);
    }

    // Sipariş ekle
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_id' => $_POST['user_id'],
                'total_amount' => $_POST['total_amount'],
                'status' => $_POST['status'],
                'payment_status' => $_POST['payment_status'],
                'shipping_address' => $_POST['shipping_address'],
                'shipping_phone' => $_POST['shipping_phone'],
                'shipping_email' => $_POST['shipping_email'],
                'notes' => $_POST['notes']
            ];

            if ($this->orderModel->addOrder($data)) {
                redirect('orders');
            }
        }

        $this->view('orders/create');
    }

    // Siparişi güncelle
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'user_id' => $_POST['user_id'],
                'total_amount' => $_POST['total_amount'],
                'status' => $_POST['status'],
                'payment_status' => $_POST['payment_status'],
                'shipping_address' => $_POST['shipping_address'],
                'shipping_phone' => $_POST['shipping_phone'],
                'shipping_email' => $_POST['shipping_email'],
                'notes' => $_POST['notes']
            ];

            if ($this->orderModel->updateOrder($data)) {
                redirect('orders/show/' . $id);
            }
        }

        $order = $this->orderModel->getOrderById($id);
        $data = [
            'order' => $order
        ];

        $this->view('orders/update', $data);
    }

    // Siparişi sil
    public function delete($id) {
        if ($this->orderModel->deleteOrder($id)) {
            redirect('orders');
        }
    }
}
?>
