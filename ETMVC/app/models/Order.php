<?php

class Order {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Siparişleri getir
    public function getAllOrders() {
        $this->db->query('SELECT o.*, u.name as user_name 
                          FROM orders o 
                          LEFT JOIN users u ON o.user_id = u.id 
                          ORDER BY o.created_at DESC');
        return $this->db->resultSet();
    }

    // Siparişi ID ile getir
    public function getOrderById($id) {
        $this->db->query('SELECT o.*, u.name as user_name 
                          FROM orders o 
                          LEFT JOIN users u ON o.user_id = u.id 
                          WHERE o.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Sipariş ekle
    public function addOrder($data) {
        $this->db->query('INSERT INTO orders (user_id, total_amount, status, payment_status, shipping_address, shipping_phone, shipping_email, notes) 
                          VALUES (:user_id, :total_amount, :status, :payment_status, :shipping_address, :shipping_phone, :shipping_email, :notes)');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':total_amount', $data['total_amount']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':payment_status', $data['payment_status']);
        $this->db->bind(':shipping_address', $data['shipping_address']);
        $this->db->bind(':shipping_phone', $data['shipping_phone']);
        $this->db->bind(':shipping_email', $data['shipping_email']);
        $this->db->bind(':notes', $data['notes']);

        return $this->db->execute();
    }

    // Siparişi güncelle
    public function updateOrder($data) {
        $this->db->query('UPDATE orders SET 
                          user_id = :user_id, 
                          total_amount = :total_amount, 
                          status = :status, 
                          payment_status = :payment_status, 
                          shipping_address = :shipping_address, 
                          shipping_phone = :shipping_phone, 
                          shipping_email = :shipping_email, 
                          notes = :notes 
                          WHERE id = :id');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':total_amount', $data['total_amount']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':payment_status', $data['payment_status']);
        $this->db->bind(':shipping_address', $data['shipping_address']);
        $this->db->bind(':shipping_phone', $data['shipping_phone']);
        $this->db->bind(':shipping_email', $data['shipping_email']);
        $this->db->bind(':notes', $data['notes']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    // Siparişi sil
    public function deleteOrder($id) {
        $this->db->query('DELETE FROM orders WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
?>
