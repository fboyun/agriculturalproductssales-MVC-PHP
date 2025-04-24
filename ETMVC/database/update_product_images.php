<?php
require_once __DIR__ . '/../core/Database.php';

$db = new Database();

// Ürün fotoğraflarını güncelle
$updates = [
    1 => 'domates.jpg',
    2 => 'salatalik.jpg',
    3 => 'elma.jpg',
    4 => 'portakal.jpg',
    5 => 'mercimek.jpg',
    6 => 'antep-fistigi.jpg'
];

foreach ($updates as $id => $image) {
    $db->query('UPDATE products SET image = :image WHERE id = :id');
    $db->bind(':id', $id);
    $db->bind(':image', $image);
    $db->execute();
    
    echo "Ürün #$id fotoğrafı güncellendi: $image\n";
} 