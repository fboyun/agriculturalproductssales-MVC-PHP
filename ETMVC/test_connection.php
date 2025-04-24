<?php

require_once 'core/Database.php';

// Database sınıfının bir örneğini oluştur
$db = new Database();

// Basit bir sorgu dene
$db->query("SELECT 1");
try {
    $db->execute();
    echo "\nTest sorgusu başarılı!";
} catch(PDOException $e) {
    echo "\nSorgu hatası: " . $e->getMessage();
} 