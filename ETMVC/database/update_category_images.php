<?php
require_once __DIR__ . '/../core/Database.php';

$db = new Database();

// Kategori resimlerini güncelle
$updates = [
    1 => 'sebzeler.jpg',
    2 => 'meyveler.jpg',
    3 => 'bakliyat.jpg',
    4 => 'kuruyemis.jpg'
];

foreach ($updates as $id => $image) {
    $db->query('UPDATE categories SET image = :image WHERE id = :id');
    $db->bind(':id', $id);
    $db->bind(':image', $image);
    $db->execute();
    
    echo "Kategori #$id resmi güncellendi: $image\n";
} 