<?php
session_start();  // Start the session

// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the product ID from the URL
$productId = isset($_GET['id']) ? $_GET['id'] : '';

if ($productId) {
    // Query to fetch the product details by ID
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId); // Using 'i' for integer type
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        // Display product details
        $productName = $product['name'];
        $productDescription = $product['description'];
        $productPrice = $product['price'];
        $productImage = $product['image']; // Assuming you have an 'image' field
    } else {
        $error = "Product not found!";
    }
} else {
    $error = "No product ID provided.";
}

$conn->close();

// Handle adding to cart
if (isset($_POST['add_to_cart'])) {
    // Check if the cart already exists in the session, if not, initialize it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add product to the cart (this assumes each product is unique in the cart)
    $cartItem = array(
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'quantity' => 1  // You can allow quantity to be set from the form as well
    );

    // Check if the product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] += 1;  // Increase quantity if the product already exists in the cart
            $found = true;
            break;
        }
    }

    // If the product was not found, add it as a new item
    if (!$found) {
        $_SESSION['cart'][] = $cartItem;
    }

    // Redirect to the cart page or show a success message
    header('Location: cart.php');  // You can create a cart.php page to show cart contents
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Product Details</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-6">
                    <!-- Display product image -->
                    <?php if (isset($productImage) && $productImage): ?>
                        <img src="uploads/<?php echo $productImage; ?>" alt="Product Image" class="img-fluid">
                    <?php else: ?>
                        <img src="default-image.jpg" alt="Default Image" class="img-fluid">
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <h3><?php echo $productName; ?></h3>
                    <p><?php echo $productDescription; ?></p>
                    <p><strong>Price:</strong> $<?php echo $productPrice; ?></p>

                    <!-- Add to Cart form -->
                    <form method="POST">
                        <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
