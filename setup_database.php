<?php
// Database setup script
// This will create the it271 database and users table

// Database connection settings
$host = "localhost";
$username = "root";
$password = "";

// Better error handling
try {
    // First check if MySQL is running
    $conn = @new mysqli($host, $username, $password);
    
    if ($conn->connect_error) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Database Setup Error</title>
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
                <h1>Database Setup Error</h1>
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
                
                <p><strong>Error details:</strong> <?php echo $conn->connect_error; ?></p>
                
                <a href="setup_database.php" class="btn">Try Again</a>
            </div>
        </body>
        </html>
        <?php
        exit;
    }

    echo "<h1>Database Setup</h1>";

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS it271";
    if ($conn->query($sql) === TRUE) {
        echo "Database 'it271' created successfully or already exists.<br>";
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
        exit;
    }

    // Select the database
    $conn->select_db("it271");

    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        usersname VARCHAR(100) NOT NULL PRIMARY KEY,
        password VARCHAR(100) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table 'users' created successfully or already exists.<br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
        exit;
    }

    // Check if test user exists, add if not
    $sql = "SELECT * FROM users WHERE usersname = 'test@example.com'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Insert a test user
        $sql = "INSERT INTO users (usersname, password) VALUES ('test@example.com', 'password123')";
        if ($conn->query($sql) === TRUE) {
            echo "Test user created with:<br>";
            echo "Username: test@example.com<br>";
            echo "Password: password123<br>";
        } else {
            echo "Error creating test user: " . $conn->error . "<br>";
        }
    } else {
        echo "Test user already exists.<br>";
    }

    // Success message
    echo "<div style='margin-top: 20px; padding: 15px; background-color: #dff0d8; border-radius: 5px;'>";
    echo "<h3 style='color: #3c763d;'>Setup Completed Successfully!</h3>";
    echo "<p>Your database and tables have been created. You can now:</p>";
    echo "<ul>";
    echo "<li><a href='signuplogin.php'>Go to the login page</a></li>";
    echo "</ul>";
    echo "</div>";

    $conn->close();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?> 