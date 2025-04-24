<?php

class Products extends Controller {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = $this->model('Product');
        $this->categoryModel = $this->model('Category');
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();

        $data = [
            'title' => 'Ürünler',
            'products' => $products,
            'categories' => $categories
        ];

        $this->view('products/index', $data);
    }

    public function getProductsByCategory() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category_id'])) {
            $categoryId = $_POST['category_id'];
            
            if($categoryId == 0) {
                $products = $this->productModel->getAllProducts();
            } else {
                $products = $this->productModel->getProductsByCategory($categoryId);
            }

            // JSON response
            header('Content-Type: application/json');
            echo json_encode($products);
            exit;
        }
    }

    public function show($id) {
        $product = $this->productModel->getProductById($id);
        
        if(!$product) {
            redirect('products');
        }

        $similarProducts = $this->productModel->getProductsByCategory($product->category_id);

        $data = [
            'title' => $product->name,
            'product' => $product,
            'similar_products' => $similarProducts
        ];

        $this->view('products/show', $data);
    }

    public function category($id) {
        $category = $this->categoryModel->getCategoryById($id);
        
        if(!$category) {
            redirect('products');
        }

        $products = $this->productModel->getProductsByCategory($id);

        $data = [
            'title' => $category->name,
            'category' => $category,
            'products' => $products
        ];

        $this->view('products/category', $data);
    }
} 