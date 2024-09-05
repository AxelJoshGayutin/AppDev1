<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = 'DELETE FROM PRODUCTS WHERE ID = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    echo 'Product deleted successfully';
}

header('Location: retrieve.php');
exit();
