<?php

class Category {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllCategories() {
        $this->db->query('SELECT c.*, COUNT(p.id) as product_count 
                          FROM categories c 
                          LEFT JOIN products p ON c.id = p.category_id 
                          GROUP BY c.id 
                          ORDER BY c.name ASC');
        return $this->db->resultSet();
    }

    public function getCategoryById($id) {
        $this->db->query('SELECT * FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateCategoryImage($id, $image) {
        $this->db->query('UPDATE categories SET image = :image WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':image', $image);
        return $this->db->execute();
    }

    public function getTotalCategories() {
        $this->db->query('SELECT COUNT(*) as total FROM categories');
        $row = $this->db->single();
        return $row->total;
    }

    public function addCategory($data) {
        $this->db->query('INSERT INTO categories (name, description, image, status) 
                          VALUES (:name, :description, :image, :status)');
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':status', $data['status']);

        return $this->db->execute();
    }

    public function updateCategory($data) {
        $this->db->query('UPDATE categories 
                          SET name = :name, 
                              description = :description, 
                              image = :image, 
                              status = :status 
                          WHERE id = :id');
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    public function deleteCategory($id) {
        // Önce kategoriye ait ürünleri kontrol et
        $this->db->query('SELECT COUNT(*) as count FROM products WHERE category_id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        
        if($result->count > 0) {
            return false; // Kategoride ürün varsa silme
        }
        
        $this->db->query('DELETE FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function updateCategoryStatus($categoryId, $status) {
        $this->db->query('UPDATE categories SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $categoryId);
        return $this->db->execute();
    }
} 