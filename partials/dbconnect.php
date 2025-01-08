
<?php 
include 'constant.php'; // Make sure this file contains the constants for SERVERNAME, USERNAME, PASSWORD, DATABASE

// Create a connection
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



