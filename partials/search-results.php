<?php
// search-results.php
include 'header.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the URL
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Fetch products based on the search query
$sql = "SELECT * FROM products WHERE name LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $searchQuery . "%"; // Add wildcard for LIKE
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Header -->
    <?php 
    include 'partials/header.php';
    ?>

    <!-- Search Results -->
    <div class="container mt-5">
        <h2>Search Results for: "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
        
        <?php if (count($products) > 0): ?>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="uploads/<?php echo $product['image']; ?>" alt="Product Image" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                <p class="card-text"><?php echo $product['description']; ?></p>
                                <p><strong>$<?php echo $product['price']; ?></strong></p>
                                <a href="product-details.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>

                                <!-- Add to Cart Button -->
                                <form action="add_to_cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <button type="submit" class="btn btn-success mt-2">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No products found matching your search.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php 
    include 'footer.php';
    ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
