<?php
class CartModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getCartItems($user_id) {
        $this->db->query('SELECT c.*, p.name, p.price, p.image, p.stock, (p.price * c.quantity) as total_price 
                         FROM cart c 
                         JOIN products p ON c.product_id = p.id 
                         WHERE c.user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function addToCart($data) {
        // Önce ürünün sepette olup olmadığını kontrol et
        $this->db->query('SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':product_id', $data['product_id']);
        $existingItem = $this->db->single();

        if($existingItem) {
            // Ürün zaten sepette varsa miktarı güncelle
            $this->db->query('UPDATE cart 
                             SET quantity = quantity + :quantity 
                             WHERE user_id = :user_id AND product_id = :product_id');
        } else {
            // Ürün sepette yoksa yeni ekle
            $this->db->query('INSERT INTO cart (user_id, product_id, quantity) 
                             VALUES (:user_id, :product_id, :quantity)');
        }

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':quantity', $data['quantity']);

        return $this->db->execute();
    }

    public function updateCartItem($data) {
        if($data['quantity'] <= 0) {
            return $this->removeFromCart($data['user_id'], $data['product_id']);
        }

        $this->db->query('UPDATE cart 
                         SET quantity = :quantity 
                         WHERE user_id = :user_id AND product_id = :product_id');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':quantity', $data['quantity']);

        return $this->db->execute();
    }

    public function removeFromCart($user_id, $product_id) {
        $this->db->query('DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':product_id', $product_id);
        return $this->db->execute();
    }

    public function getCartTotal($user_id) {
        $this->db->query('SELECT SUM(p.price * c.quantity) as total 
                         FROM cart c 
                         JOIN products p ON c.product_id = p.id 
                         WHERE c.user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $result = $this->db->single();
        return $result->total ?? 0;
    }

    public function getCartItemCount($user_id) {
        $this->db->query('SELECT COUNT(*) as count FROM cart WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $result = $this->db->single();
        return $result->count ?? 0;
    }

    public function emptyCart($user_id) {
        $this->db->query('DELETE FROM cart WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->execute();
    }
} 