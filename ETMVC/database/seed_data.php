<?php

require_once __DIR__ . '/../core/Database.php';

$db = new Database();

// Kategoriler ekle
$categories = [
    ['name' => 'Sebzeler', 'slug' => 'sebzeler', 'description' => 'Taze sebzeler'],
    ['name' => 'Meyveler', 'slug' => 'meyveler', 'description' => 'Taze meyveler'],
    ['name' => 'Bakliyat', 'slug' => 'bakliyat', 'description' => 'Kuru bakliyat ürünleri'],
    ['name' => 'Kuruyemiş', 'slug' => 'kuruyemis', 'description' => 'Taze kuruyemiş çeşitleri']
];

foreach ($categories as $category) {
    $db->query("INSERT INTO categories (name, slug, description) VALUES (:name, :slug, :description)");
    $db->bind(':name', $category['name']);
    $db->bind(':slug', $category['slug']);
    $db->bind(':description', $category['description']);
    $db->execute();
}

echo "Kategoriler eklendi.\n";

// Ürünler ekle
$products = [
    [
        'category_id' => 1, // Sebzeler
        'name' => 'Domates',
        'slug' => 'domates',
        'description' => 'Taze salkım domates',
        'price' => 19.99,
        'stock' => 100,
        'image' => 'domates.jpg'
    ],
    [
        'category_id' => 1, // Sebzeler
        'name' => 'Salatalık',
        'slug' => 'salatalik',
        'description' => 'Taze salatalık',
        'price' => 14.99,
        'stock' => 150,
        'image' => 'salatalik.jpg'
    ],
    [
        'category_id' => 2, // Meyveler
        'name' => 'Elma',
        'slug' => 'elma',
        'description' => 'Taze Amasya elması',
        'price' => 24.99,
        'stock' => 200,
        'image' => 'elma.jpg'
    ],
    [
        'category_id' => 2, // Meyveler
        'name' => 'Portakal',
        'slug' => 'portakal',
        'description' => 'Taze Washington portakalı',
        'price' => 22.99,
        'stock' => 180,
        'image' => 'portakal.jpg'
    ],
    [
        'category_id' => 3, // Bakliyat
        'name' => 'Kırmızı Mercimek',
        'slug' => 'kirmizi-mercimek',
        'description' => '1 kg paket kırmızı mercimek',
        'price' => 49.99,
        'stock' => 300,
        'image' => 'mercimek.jpg'
    ],
    [
        'category_id' => 4, // Kuruyemiş
        'name' => 'Antep Fıstığı',
        'slug' => 'antep-fistigi',
        'description' => '250 gr kavrulmuş Antep fıstığı',
        'price' => 159.99,
        'stock' => 50,
        'image' => 'antep-fistigi.jpg'
    ]
];

foreach ($products as $product) {
    $db->query("INSERT INTO products (category_id, name, slug, description, price, stock, image) 
                VALUES (:category_id, :name, :slug, :description, :price, :stock, :image)");
    $db->bind(':category_id', $product['category_id']);
    $db->bind(':name', $product['name']);
    $db->bind(':slug', $product['slug']);
    $db->bind(':description', $product['description']);
    $db->bind(':price', $product['price']);
    $db->bind(':stock', $product['stock']);
    $db->bind(':image', $product['image']);
    $db->execute();
}

echo "Ürünler eklendi.\n";

// Örnek kullanıcı ekle
$db->query("INSERT INTO users (name, email, password, address, phone, role) 
            VALUES (:name, :email, :password, :address, :phone, :role)");
$db->bind(':name', 'Admin User');
$db->bind(':email', 'admin@example.com');
$db->bind(':password', password_hash('admin123', PASSWORD_DEFAULT));
$db->bind(':address', 'Örnek Adres, İstanbul');
$db->bind(':phone', '5551234567');
$db->bind(':role', 'admin');
$db->execute();

$db->query("INSERT INTO users (name, email, password, address, phone, role) 
            VALUES (:name, :email, :password, :address, :phone, :role)");
$db->bind(':name', 'Test User');
$db->bind(':email', 'user@example.com');
$db->bind(':password', password_hash('user123', PASSWORD_DEFAULT));
$db->bind(':address', 'Test Adres, Ankara');
$db->bind(':phone', '5559876543');
$db->bind(':role', 'user');
$db->execute();

echo "Kullanıcılar eklendi.\n";

// Örnek sipariş ekle
$db->query("INSERT INTO orders (user_id, total_amount, status, shipping_address, shipping_phone, shipping_email) 
            VALUES (:user_id, :total_amount, :status, :shipping_address, :shipping_phone, :shipping_email)");
$db->bind(':user_id', 2); // Test User
$db->bind(':total_amount', 107.96);
$db->bind(':status', 'pending');
$db->bind(':shipping_address', 'Test Adres, Ankara');
$db->bind(':shipping_phone', '5559876543');
$db->bind(':shipping_email', 'user@example.com');
$db->execute();

$order_id = $db->dbh->lastInsertId();

// Sipariş ürünlerini ekle
$order_items = [
    [
        'product_id' => 1,
        'quantity' => 2,
        'price' => 19.99
    ],
    [
        'product_id' => 2,
        'quantity' => 3,
        'price' => 14.99
    ],
    [
        'product_id' => 3,
        'quantity' => 1,
        'price' => 24.99
    ]
];

foreach ($order_items as $item) {
    $db->query("INSERT INTO order_items (order_id, product_id, quantity, price) 
                VALUES (:order_id, :product_id, :quantity, :price)");
    $db->bind(':order_id', $order_id);
    $db->bind(':product_id', $item['product_id']);
    $db->bind(':quantity', $item['quantity']);
    $db->bind(':price', $item['price']);
    $db->execute();
}

echo "Sipariş ve sipariş detayları eklendi.\n"; 