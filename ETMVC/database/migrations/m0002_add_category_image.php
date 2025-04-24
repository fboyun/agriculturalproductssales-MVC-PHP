<?php
class m0002_add_category_image {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function up() {
        $sql = "ALTER TABLE categories ADD COLUMN image VARCHAR(255) AFTER description";

        try {
            $this->db->query($sql);
            return $this->db->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function down() {
        $sql = "ALTER TABLE categories DROP COLUMN image";

        try {
            $this->db->query($sql);
            return $this->db->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
} 