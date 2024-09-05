<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $toCreate = date('Y-m-d H:i:s'); // Current timestamp
    $toUpdate = $toCreate; // Same timestamp for creation and update initially

    $sql = 'INSERT INTO PRODUCTS (Name, Description, Price, Quantity, ToCreate, ToUpdate) VALUES (:name, :description, :price, :quantity, :toCreate, :toUpdate)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'toCreate' => $toCreate,
        'toUpdate' => $toUpdate
    ]);

    echo 'Product created successfully';
}
?>

<form method="post" action="create.php">
    Name: <input type="text" name="name" required><br>
    Description: <input type="text" name="description" required><br>
    Price: <input type="number" step="0.01" name="price" required><br>
    Quantity: <input type="number" name="quantity" required><br>
    <input type="submit" value="Create">
</form>
