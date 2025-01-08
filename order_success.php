<?php
session_start(); // Start the session to access session data
$totalAmount = isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : 0; // Get the total amount from session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="styles3.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="order-success-card">
        <!-- Success Check Mark Icon -->
        <div class="text-center">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 class="text-center">Order Placed Successfully!</h1>
        <p class="text-center">Thank you for your purchase. We are processing your order and will ship it soon.</p>
        
        <!-- Display Total Amount -->
        <div class="text-center mb-4">
            <h3>Total Amount: $<?php echo number_format($totalAmount, 2); ?></h3>
        </div>

        <!-- PayPal Payment Button -->
        <div class="text-center button-group">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="YOUR_PAYPAL_EMAIL_HERE">
                <input type="hidden" name="item_name" value="Order Payment">
                <input type="hidden" name="amount" value="<?php echo number_format($totalAmount, 2); ?>">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="return" value="http://yourwebsite.com/order-success.php">
                <input type="hidden" name="cancel_return" value="http://yourwebsite.com/order-cancel.php">
                <input type="submit" class="btn-custom" value="Pay with PayPal">
            </form>
        </div>

        <!-- Continue Shopping Button -->
        <div class="text-center button-group">
            <a href="index.php" class="btn-custom">Continue Shopping</a>
        </div>

        <div class="back-to-home">
            <p>Or, go back to the <a href="index.php">homepage</a>.</p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
