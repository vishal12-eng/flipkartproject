<?php
include 'partials/dbconnect.php';

$query = isset($_GET['query']) ? $_GET['query'] : '';
$sql = "SELECT id, name, description, price, image FROM products WHERE name LIKE ? LIMIT 2"; // Fetch the product image as well
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $query . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row; // Collect matching products
}

echo json_encode($products); // Return products as a JSON response
$conn->close();
?>
