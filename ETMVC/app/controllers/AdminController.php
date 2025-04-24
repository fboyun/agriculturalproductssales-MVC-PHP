<?php
class AdminController extends Controller {
    private $adminModel;
   
    public function __construct() {
        // Parent constructor'ı çağırmıyoruz çünkü cart modeline ihtiyacımız yok
        $this->adminModel = $this->model('AdminModel');
        if($this->getAction() != 'login') {
            $this->checkAuth();
        }
    }
 
    
    private function getAction() {
        $url = isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : ['home'];
        return isset($url[1]) ? $url[1] : 'index';
    }
    
    private function checkAuth() {
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }
        
    }
    
    public function index() {
        // Tüm siparişleri getir
        $orders = $this->adminModel->getAllOrders();
        $this->view('admin/dashboard', ['orders' => $orders]);
        
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($email === 'admin@admin.com' && $password === 'admin123') {
                $_SESSION['admin'] = true;
                header('Location: ' . BASE_URL . '/admin');
                exit;
            } else {
                $error = 'Geçersiz kullanıcı adı veya şifre!';
                $this->view('admin/login', ['error' => $error]);
            }
        } else {
            $this->view('admin/login');
        }
    }
    
    public function logout() {
        unset($_SESSION['admin']);
        header('Location: ' . BASE_URL . '/admin/login');
        exit;
}
 }