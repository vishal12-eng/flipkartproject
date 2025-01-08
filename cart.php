<?php
session_start();  // Start the session

// Check if there are any items in the cart
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
} else {
    $cartItems = [];
}

$total = 0;  // Initialize total price

// Handle product removal from cart
if (isset($_GET['remove_id'])) {
    $removeId = $_GET['remove_id'];
    // Remove the product with the specified ID from the cart
    unset($_SESSION['cart'][$removeId]);

    // Refresh the page to show the updated cart
    header('Location: cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles for Cart */
        .cart-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        .cart-item h5 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .cart-item .product-price {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .cart-item .product-quantity {
            width: 60px;
        }
        .cart-total {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
        .cart-actions {
            margin-top: 30px;
            text-align: center;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .no-image {
            display: inline-block;
            width: 100px;
            height: 100px;
            background-color: #f0f0f0;
            color: #888;
            text-align: center;
            line-height: 100px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .btn-remove {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-remove:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Your Shopping Cart</h1>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-warning text-center">
            Your cart is empty. <a href="index.php" class="btn btn-primary">Continue Shopping</a>
        </div>
    <?php else: ?>
        <form id="cartForm" method="POST" action="cart.php">
            <div class="row">
                <div class="col-12">
                    <?php foreach ($cartItems as $productId => $item): ?>
                        <div class="cart-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <!-- Check if image exists, otherwise show 'No Image' -->
                                <?php if (!empty($item['image'])): ?>
                                    <img src="uploads/<?php echo $item['image']; ?>" alt="Product Image">
                                <?php else: ?>
                                    <div class="no-image">No Image</div>
                                <?php endif; ?>
                                <div class="ml-3">
                                    <h5><?php echo htmlspecialchars($item['name']); ?></h5>
                                    <p class="product-price" id="price-<?php echo $productId; ?>">$<?php echo number_format($item['price'], 2); ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- Quantity input field -->
                                <input type="number" name="quantity[<?php echo $productId; ?>]" id="quantity-<?php echo $productId; ?>" value="<?php echo $item['quantity']; ?>" class="product-quantity form-control" min="1" onchange="updatePrice('<?php echo $productId; ?>')">
                                <p class="ml-3" id="total-<?php echo $productId; ?>">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                            </div>
                            <!-- Delete button for each item -->
                            <div>
                                <a href="cart.php?remove_id=<?php echo $productId; ?>" class="btn-remove">Delete</a>
                            </div>
                        </div>
                        <?php $total += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>

                    <div class="cart-total">
                        <p>Total: $<span id="totalAmount"><?php echo number_format($total, 2); ?></span></p>
                    </div>

                    <div class="cart-actions">
                        <a href="index.php" class="btn btn-custom">Continue Shopping</a>
                        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
// Function to update the total price dynamically when the quantity is changed
function updatePrice(productId) {
    // Get the quantity entered by the user
    var quantity = document.getElementById('quantity-' + productId).value;
    
    // Get the unit price of the product
    var price = parseFloat(document.getElementById('price-' + productId).innerText.replace('$', ''));
    
    // Calculate the new total for this item
    var totalPrice = price * quantity;
    
    // Update the total price for the item
    document.getElementById('total-' + productId).innerText = '$' + totalPrice.toFixed(2);
    
    // Recalculate the overall total amount
    var totalAmount = 0;
    var totalElements = document.querySelectorAll('.cart-item p[id^="total-"]');
    totalElements.forEach(function(item) {
        totalAmount += parseFloat(item.innerText.replace('$', ''));
    });
    
    // Update the total price display
    document.getElementById('totalAmount').innerText = totalAmount.toFixed(2);
}
</script>

</body>
</html>
