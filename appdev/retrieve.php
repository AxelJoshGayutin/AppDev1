<?php
include 'config.php';

// Handle deletion if the delete button is clicked
if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    
    // Prepare and execute SQL statement to delete the product
    $sql = 'DELETE FROM PRODUCTS WHERE ID = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $idToDelete]);

    // Redirect to the same page to refresh the product list
    header('Location: retrieve.php');
    exit();
}

// Query to retrieve all records from the PRODUCTS table
$sql = 'SELECT * FROM PRODUCTS';
$stmt = $pdo->query($sql);

// Fetch all records
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Products</title>
</head>
<body>
    <h1>Product List</h1>

    <!-- Button to retrieve data -->
    <form method="get" action="retrieve.php">
        <button type="submit">Refresh Data</button>
    </form>

    <!-- Table to display products -->
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>ToCreate</th>
            <th>ToUpdate</th>
            <th>Actions</th>
        </tr>
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['ID']); ?></td>
                    <td><?php echo htmlspecialchars($product['Name']); ?></td>
                    <td><?php echo htmlspecialchars($product['Description']); ?></td>
                    <td><?php echo htmlspecialchars($product['Price']); ?></td>
                    <td><?php echo htmlspecialchars($product['Quantity']); ?></td>
                    <td><?php echo htmlspecialchars($product['ToCreate']); ?></td>
                    <td><?php echo htmlspecialchars($product['ToUpdate']); ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $product['ID']; ?>">Update</a> |
                        <a href="retrieve.php?delete=<?php echo $product['ID']; ?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No products found.</td>
            </tr>
        <?php endif; ?>
    </table>

    <br>
    <a href="create.php">Add New Product</a>
</body>
</html>
