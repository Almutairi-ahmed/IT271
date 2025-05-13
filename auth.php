<?php
// Database connection
$host = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP empty password
$dbname = "it271"; // Your database name

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    // Get values from form
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    // Check if username already exists
    $sql = "SELECT * FROM users WHERE usersname = '$email'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        echo "Email already exists";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (usersname, password) VALUES ('$email', '$pass')";
        
        if ($conn->query($sql) === TRUE) {
            echo "registration successful";
        } else {
            echo "registration failed: " . $conn->error;
        }
    }
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    // Get values from form
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    // Check credentials
    $sql = "SELECT * FROM users WHERE usersname = '$email' AND password = '$pass'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        echo "login successful";
    } else {
        echo "invalid username or password";
    }
}

$conn->close();
?>