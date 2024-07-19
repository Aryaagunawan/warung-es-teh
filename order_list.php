<?php
require 'db_config.php';

try {
    $stmt = $pdo->query('SELECT * FROM orders');
    $orders = $stmt->fetchAll();
} catch (\PDOException $e) {
    echo 'Terjadi kesalahan: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Daftar Pesanan</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Nomor HP</th>
                <th>Kode Pos</th>
                <th>Jumlah Pesanan</th>
                <th>Menu Minuman</th>
                <th>Total Harga</th>
                <th>Tanggal Pesanan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= htmlspecialchars($order['name']) ?></td>
                    <td><?= htmlspecialchars($order['phone']) ?></td>
                    <td><?= htmlspecialchars($order['postal_code']) ?></td>
                    <td><?= htmlspecialchars($order['quantity']) ?></td>
                    <td><?= htmlspecialchars($order['menu']) ?></td>
                    <td><?= htmlspecialchars($order['total']) ?></td>
                    <td><?= isset($order['order_date']) ? htmlspecialchars($order['order_date']) : 'N/A' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>