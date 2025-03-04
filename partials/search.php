<?php
include'dbconnect.php';
$searchQuery = isset($_GET['query']) ? $_GET['query'] : ''; // Get search query

// Query to fetch products based on search query
$sql = "SELECT * FROM products WHERE name LIKE ?"; 
$stmt = $conn->prepare($sql);
$searchTerm = "%$searchQuery%"; // Adds the wildcard for the LIKE query
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$products = [];

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Return products as a JSON response
echo json_encode($products);

$conn->close();
?>

