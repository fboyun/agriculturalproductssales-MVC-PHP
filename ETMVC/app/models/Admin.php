<?php
class AdminModel extends Model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllOrders() {
        try {
            // Ana sipariş bilgilerini al
            $this->db->query(
                'SELECT orders.*, users2.name as user_name 
                 FROM orders 
                 LEFT JOIN users2 ON orders.user_id = users2.id 
                 ORDER BY orders.created_at DESC'
            );
            $orders = $this->db->resultSet();

            if ($orders) {
                // Her sipariş için ürün detaylarını al
                foreach ($orders as &$order) {
                    $this->db->query(
                        'SELECT order_items.*, products.name as product_name 
                         FROM order_items 
                         LEFT JOIN products ON order_items.product_id = products.id 
                         WHERE order_items.order_id = :order_id'
                    );
                    $this->db->bind(':order_id', $order['id']);
                    $order['items'] = $this->db->resultSet();
                }
            }
            return $orders;
        } catch (PDOException $e) {
            error_log("Sipariş getirme hatası: " . $e->getMessage());
            return [];
        }
    }

    public function getOrderById($order_id) {
        try {
            // Sipariş bilgilerini al
            $this->db->query(
                'SELECT orders.*, users2.name as user_name 
                 FROM orders 
                 LEFT JOIN users2 ON orders.user_id = users2.id 
                 WHERE orders.id = :order_id'
            );
            $this->db->bind(':order_id', $order_id);
            $order = $this->db->single();

            if ($order) {
                // Sipariş ürün detaylarını al
                $this->db->query(
                    'SELECT order_items.*, products.name as product_name 
                     FROM order_items 
                     LEFT JOIN products ON order_items.product_id = products.id 
                     WHERE order_items.order_id = :order_id'
                );
                $this->db->bind(':order_id', $order_id);
                $order['items'] = $this->db->resultSet();
            }
            return $order;
        } catch (PDOException $e) {
            error_log("Sipariş bilgisi getirme hatası: " . $e->getMessage());
            return null;
        }
    }

    public function updateOrderStatus($order_id, $status) {
        try {
            $this->db->query(
                'UPDATE orders 
                 SET status = :status 
                 WHERE id = :order_id'
            );
            $this->db->bind(':status', $status);
            $this->db->bind(':order_id', $order_id);

            return $this->db->execute();
        } catch (PDOException $e) {
            error_log("Sipariş durumu güncelleme hatası: " . $e->getMessage());
            return false;
        }
    }

    public function deleteOrder($order_id) {
        try {
            // İlk olarak, ilgili sipariş ürünlerini sil
            $this->db->query(
                'DELETE FROM order_items WHERE order_id = :order_id'
            );
            $this->db->bind(':order_id', $order_id);
            $this->db->execute();

            // Ardından, siparişi sil
            $this->db->query(
                'DELETE FROM orders WHERE id = :order_id'
            );
            $this->db->bind(':order_id', $order_id);

            return $this->db->execute();
        } catch (PDOException $e) {
            error_log("Sipariş silme hatası: " . $e->getMessage());
            return false;
        }
    }
}
