<?php
 session_start();
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    $sql = "Select * from users where user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
           
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['username'] = $email;
            echo "logged in". $email;
                  // Set login success message in session
                  $_SESSION['loginAlert'] = "Login successful! Welcome, " . $email;
            
                  // Redirect to index.php
                  header("Location: /flipkart");
                  exit();
              } else {
                  // Password incorrect
                  $_SESSION['loginAlert'] = "Invalid password!";
                  header("Location: /flipkart");
                  exit();
              }
          } else {
              // User not found
              $_SESSION['loginAlert'] = "User not found!";
              header("Location: /flipkart");
              exit();
          }
          
      }
      ?>