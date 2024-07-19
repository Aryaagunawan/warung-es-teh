<?php
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $phone = $data['phone'];
    $postal_code = $data['postal_code'];
    $quantity = $data['quantity'];
    $menu = $data['menu'];

    $prices = [
        'es_tea_sweet' => 3000,
        'es_tea_plain' => 2000,
        'es_lemon_tea' => 5000,
        'es_tea_jumbo' => 4000
    ];

    if (isset($prices[$menu])) {
        $total = $quantity * $prices[$menu];

        // Perbaikan query untuk memasukkan tanggal pesanan
        $stmt = $pdo->prepare('INSERT INTO orders (name, phone, postal_code, quantity, menu, total, order_date) VALUES (?, ?, ?, ?, ?, ?, NOW())');
        if ($stmt->execute([$name, $phone, $postal_code, $quantity, $menu, $total])) {
            echo 'Pemesanan berhasil!';
        } else {
            echo 'Terjadi kesalahan, coba lagi.';
        }
    } else {
        echo 'Menu tidak valid.';
    }
}
