<?php

class OrderItem {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Sipariş öğelerini getir
    public function getOrderItemsByOrderId($orderId) {
        $this->db->query('SELECT oi.*, p.name as product_name, p.price 
                          FROM order_items oi 
                          LEFT JOIN products p ON oi.product_id = p.id 
                          WHERE oi.order_id = :order_id');
        $this->db->bind(':order_id', $orderId);
        return $this->db->resultSet();
    }

    // Sipariş öğesi ekle
    public function addOrderItem($data) {
        $this->db->query('INSERT INTO order_items (order_id, product_id, quantity, price) 
                          VALUES (:order_id, :product_id, :quantity, :price)');
        
        $this->db->bind(':order_id', $data['order_id']);
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':price', $data['price']);

        return $this->db->execute();
    }

    // Sipariş öğesini güncelle
    public function updateOrderItem($data) {
        $this->db->query('UPDATE order_items SET 
                          quantity = :quantity, 
                          price = :price 
                          WHERE id = :id');
        
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    // Sipariş öğesini sil
    public function deleteOrderItem($id) {
        $this->db->query('DELETE FROM order_items WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
?>
