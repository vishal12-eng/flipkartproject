<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdata"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
    
}

// Get product ID from POST
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';

// Fetch product details from database
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if ($product) {
    // If the product is found, add it to the cart (session)
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; // Initialize the cart if not set
    }
    $_SESSION['cart'][] = $product; // Add the product to the session cart
}

// Redirect to cart page or previous page
header('Location: cart.php');
exit();
?>
