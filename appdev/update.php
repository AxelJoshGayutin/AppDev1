<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $toUpdate = date('Y-m-d H:i:s'); // Current timestamp

    $sql = 'UPDATE PRODUCTS SET Name = :name, Description = :description, Price = :price, Quantity = :quantity, ToUpdate = :toUpdate WHERE ID = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'toUpdate' => $toUpdate
    ]);

    echo 'Product updated successfully';
} else {
    $id = $_GET['id'];

    $sql = 'SELECT * FROM PRODUCTS WHERE ID = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['ID']); ?>">
    Name: <input type="text" name="name" value="<?php echo htmlspecialchars($product['Name']); ?>" required><br>
    Description: <input type="text" name="description" value="<?php echo htmlspecialchars($product['Description']); ?>" required><br>
    Price: <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>" required><br>
    Quantity: <input type="number" name="quantity" value="<?php echo htmlspecialchars($product['Quantity']); ?>" required><br>
    <input type="submit" value="Update">
</form>
