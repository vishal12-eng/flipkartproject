<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products</title>

    <!-- Bootstrap CSS link for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="styles5.css"> 
</head>
<body>

    <!-- Include your header and modals (login/signup) -->
    <?php 
    include 'partials/header.php';
    include 'partials/loginmodal.php';
    include 'partials/signupmodal.php';
    ?>



    <!-- Bootstrap JS and dependencies (jQuery, Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Event listener for input changes (typing in search box)
        document.getElementById('search-input').addEventListener('input', function() {
            var searchTerm = document.getElementById('search-input').value.trim();
            if (searchTerm) {
                searchProducts(searchTerm); // Perform AJAX request when the user types
            } else {
                document.getElementById('search-results').innerHTML = ''; // Clear results when input is empty
            }
        });

        // Function to search products using AJAX
        function searchProducts(query) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'partials/search.php?query=' + query, true); // Send request to search.php
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var products = JSON.parse(xhr.responseText); // Parse JSON response
                    displaySearchResults(products); // Display the results
                }
            };
            xhr.send();
        }

        // Function to display search results in a dropdown below the search input
        function displaySearchResults(products) {
            var resultsContainer = document.getElementById('search-results');
            resultsContainer.innerHTML = ''; // Clear previous results

            if (products.length > 0) {
                products.forEach(function(product) {
                    var resultItem = document.createElement('div');
                    resultItem.classList.add('search-result-item');
                    resultItem.innerHTML = `<strong>${product.name}</strong><br>${product.description}<br><strong>$${product.price}</strong>`;

                    // Add a click event to each result item to redirect to the product details page
                    resultItem.onclick = function() {
                        // Redirect to the product details page with the product ID in the URL
                        window.location.href = 'product-details.php?id=' + product.id;
                    };

                    resultsContainer.appendChild(resultItem);
                });
            } else {
                resultsContainer.innerHTML = '<div class="search-result-item">No products found matching your search.</div>';
            }
        }
    </script>

    <!-- Include footer and other necessary content -->
    <?php
    include 'terms.php';
    include 'footer.php';
   
    ?>
</body>
</html>
