<?php
session_start(); // Start the session to access cart data

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php'); // Redirect back to the cart page if cart is empty
    exit;
}

// Initialize total amount
$totalAmount = 0;
$cartItems = $_SESSION['cart'];

// Calculate the total amount for the cart
foreach ($cartItems as $productId => $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

// Handle the form submission (e.g., user clicks on the "Checkout" button)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulate the checkout process (e.g., saving order details, payment gateway integration)
    $orderSuccess = true;  // Assume the order is successful for this demo

    if ($orderSuccess) {
        // Clear the cart after a successful checkout
        unset($_SESSION['cart']);

        // Redirect to a success page (e.g., order confirmation page)
        header('Location: order_success.php'); 
        exit;
    } else {
        // In case of failure (e.g., payment failed), display an error message
        $errorMessage = "An error occurred during the checkout process. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles4.css"> 
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Checkout</h1>

    <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger text-center">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <form action="checkout.php" method="POST">
        <div class="row">
            <div class="col-12">
                <?php foreach ($cartItems as $productId => $item): ?>
                    <div class="checkout-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <?php if (!empty($item['image'])): ?>
                                <img src="uploads/<?php echo $item['image']; ?>" alt="Product Image">
                            <?php else: ?>
                                <div class="no-image">No Image</div>
                            <?php endif; ?>
                            <div class="ml-3">
                                <h5><?php echo htmlspecialchars($item['name']); ?></h5>
                                <p class="product-price">$<?php echo number_format($item['price'], 2); ?></p>
                            </div>
                        </div>
                        <div>
                            <p class="ml-3">Quantity: <?php echo $item['quantity']; ?></p>
                            <p class="product-price">Total: $<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="checkout-total">
                    <p>Total: $<?php echo number_format($totalAmount, 2); ?></p>
                </div>


                <div class="checkout-actions">
                    <button type="submit" class="btn btn-custom">Confirm Order</button>
                    <a href="cart.php" class="btn btn-danger">Go Back to Cart</a>
                </div>

            </div>
        </div>
        <?php //Before redirecting to order_success.php, pass the total amount to the session or URL
$_SESSION['totalAmount'] = $totalAmount;
?>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
