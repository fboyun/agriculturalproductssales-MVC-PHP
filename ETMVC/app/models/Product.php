<?php

class Product {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllProducts() {
        $this->db->query('SELECT p.*, c.name as category_name 
                          FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id 
                          ORDER BY p.created_at DESC');
        return $this->db->resultSet();
    }

    public function getProductById($id) {
        $this->db->query('SELECT p.*, c.name as category_name 
                          FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id 
                          WHERE p.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getProductsByCategory($categoryId) {
        $this->db->query('SELECT p.*, c.name as category_name 
                          FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id 
                          WHERE p.category_id = :category_id');
        $this->db->bind(':category_id', $categoryId);
        return $this->db->resultSet();
    }

    public function updateProductImage($id, $image) {
        $this->db->query('UPDATE products SET image = :image WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':image', $image);
        return $this->db->execute();
    }

    // Admin fonksiyonları
    public function getTotalProducts() {
        $this->db->query('SELECT COUNT(*) as total FROM products');
        $row = $this->db->single();
        return $row->total;
    }

    public function getLatestProducts($limit = 5) {
        $this->db->query('SELECT p.*, c.name as category_name 
                          FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id 
                          ORDER BY p.created_at DESC 
                          LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    public function addProduct($data) {
        $this->db->query('INSERT INTO products (name, description, price, stock, image, category_id, status) 
                          VALUES (:name, :description, :price, :stock, :image, :category_id, :status)');
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':status', $data['status']);

        return $this->db->execute();
    }

    public function updateProduct($data) {
        $this->db->query('UPDATE products 
                          SET name = :name, 
                              description = :description, 
                              price = :price, 
                              stock = :stock, 
                              image = :image, 
                              category_id = :category_id, 
                              status = :status 
                          WHERE id = :id');
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':category_id', $data['category_id']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    public function deleteProduct($id) {
        $this->db->query('DELETE FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function updateProductStatus($productId, $status) {
        $this->db->query('UPDATE products SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $productId);
        return $this->db->execute();
    }

    public function getFeaturedProducts($limit = 4) {
        $this->db->query('SELECT p.*, c.name as category_name 
                          FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id 
                          WHERE p.status = "active" 
                          ORDER BY p.created_at DESC 
                          LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
} 