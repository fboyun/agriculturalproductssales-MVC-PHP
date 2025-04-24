<?php
class Cart extends Controller {
    private $cartModel;
    private $productModel;

    public function __construct() {
        if(!isLoggedIn()) {
            redirect('users/login');
        }
        
        $this->cartModel = $this->model('CartModel');
        $this->productModel = $this->model('Product');
    }

    public function index() {
        $cartItems = $this->cartModel->getCartItems($_SESSION['user_id']);
        $total = $this->cartModel->getCartTotal($_SESSION['user_id']);

        $data = [
            'title' => 'Sepetim',
            'cart_items' => $cartItems,
            'total' => $total
        ];

        $this->view('cart/index', $data);
    }

    public function add() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ürün stok kontrolü
            $product = $this->productModel->getProductById($_POST['product_id']);
            if(!$product || $product->stock < $_POST['quantity']) {
                $response = [
                    'success' => false,
                    'message' => 'Yetersiz stok'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }

            $data = [
                'user_id' => $_SESSION['user_id'],
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity']
            ];

            if($this->cartModel->addToCart($data)) {
                $cartCount = $this->cartModel->getCartItemCount($_SESSION['user_id']);
                $response = [
                    'success' => true,
                    'cartCount' => $cartCount
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Ürün sepete eklenirken bir hata oluştu.'
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    public function update() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ürün stok kontrolü
            $product = $this->productModel->getProductById($_POST['product_id']);
            if(!$product || $product->stock < $_POST['quantity']) {
                $response = [
                    'success' => false,
                    'message' => 'Yetersiz stok'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }

            $data = [
                'user_id' => $_SESSION['user_id'],
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity']
            ];

            if($this->cartModel->updateCartItem($data)) {
                $response = ['success' => true];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Sepet güncellenirken bir hata oluştu.'
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    public function remove() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->cartModel->removeFromCart($_SESSION['user_id'], $_POST['product_id'])) {
                $response = ['success' => true];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Ürün sepetten kaldırılırken bir hata oluştu.'
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    public function getCount() {
        $count = $this->cartModel->getCartItemCount($_SESSION['user_id']);
        
        header('Content-Type: application/json');
        echo json_encode(['count' => $count]);
        exit;
    }
} 