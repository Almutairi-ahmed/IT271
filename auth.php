<?php
// Start session
session_start();

// Database connection settings
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "it271"; 

// Better error handling
try {
    // First check if MySQL is running by trying to connect to the server
    $conn = @new mysqli($host, $username, $password);
    
    if ($conn->connect_error) {
        $error_message = "MySQL Connection Error: " . $conn->connect_error;
        
        // If MySQL is not running, show a user-friendly error page
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Database Error</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    background-color: #f8f8f8;
                    color: #333;
                }
                .error-container {
                    max-width: 600px;
                    margin: 50px auto;
                    background: white;
                    padding: 30px;
                    border-radius: 5px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                }
                h1 {
                    color: #d9534f;
                }
                .steps {
                    background-color: #f5f5f5;
                    padding: 15px;
                    border-radius: 5px;
                    margin-top: 20px;
                }
                .btn {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 10px 20px;
                    background-color: #5cb85c;
                    color: white;
                    text-decoration: none;
                    border-radius: 4px;
                }
            </style>
        </head>
        <body>
            <div class="error-container">
                <h1>Database Connection Error</h1>
                <p>The application cannot connect to the MySQL database. This usually happens when MySQL is not running.</p>
                
                <div class="steps">
                    <h3>How to fix this:</h3>
                    <ol>
                        <li>Open XAMPP Control Panel</li>
                        <li>Make sure MySQL is running (green light)</li>
                        <li>If MySQL is not running, click the "Start" button next to MySQL</li>
                        <li>If MySQL fails to start, check the MySQL logs in XAMPP</li>
                    </ol>
                </div>
                
                <p><strong>Error details:</strong> <?php echo $error_message; ?></p>
                
                <a href="signuplogin.php" class="btn">Try Again</a>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
    
    // If we're here, MySQL is running - now try to select the database
    $conn->select_db($dbname);
    
    // Handle registration
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $confirmPass = $_POST['confirm'];
        
        // Simple validation
        if (empty($email) || empty($pass)) {
            header("Location: signuplogin.php?error=empty");
            exit;
        }
        
        // Check if passwords match
        if ($pass !== $confirmPass) {
            header("Location: signuplogin.php?error=password_mismatch");
            exit;
        }
        
        // Check if username already exists
        $sql = "SELECT * FROM users WHERE usersname = '$email'";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            header("Location: signuplogin.php?error=register");
            exit;
        } else {
            // Insert new user
            $sql = "INSERT INTO users (usersname, password) VALUES ('$email', '$pass')";
            
            if ($conn->query($sql) === TRUE) {
                // Set session variables
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $email;
                
                // Redirect to welcome page
                header("Location: welcome.php");
                exit;
            } else {
                header("Location: signuplogin.php?error=db_error");
                exit;
            }
        }
    }

    // Handle login
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        
        // Simple validation
        if (empty($email) || empty($pass)) {
            header("Location: login.php?error=empty");
            exit;
        }
        
        // Check credentials
        $sql = "SELECT * FROM users WHERE usersname = '$email' AND password = '$pass'";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            // Set session variables
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $email;
            
            // Redirect to welcome page
            header("Location: welcome.php");
            exit;
        } else {
            header("Location: login.php?error=login");
            exit;
        }
    }

    $conn->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

// If no action was taken, redirect to the login page
header("Location: signuplogin.php");
exit;
?>