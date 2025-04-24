<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Email ile kullanıcı bul
    public function getUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row;
    }

    // Kullanıcı kayıt
    public function register($data) {
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
        
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Admin fonksiyonları
    public function getTotalUsers() {
        $this->db->query('SELECT COUNT(*) as total FROM users');
        $row = $this->db->single();
        return $row->total;
    }

    public function getLatestUsers($limit = 5) {
        $this->db->query('SELECT id, name, email, role, status, created_at 
                          FROM users 
                          ORDER BY created_at DESC 
                          LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    public function getAllUsers() {
        $this->db->query('SELECT id, name, email, role, status, created_at 
                          FROM users 
                          ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function updateUserStatus($userId, $status) {
        $this->db->query('UPDATE users SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    public function updateUserRole($userId, $role) {
        $this->db->query('UPDATE users SET role = :role WHERE id = :id');
        $this->db->bind(':role', $role);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    public function deleteUser($userId) {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }
} 