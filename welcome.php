<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to login page if not logged in
    header("Location: signuplogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مرحباً بك - متجر الكتب</title>
    <style>
        body {
            background-color: rgb(75 85 99 / var(--tw-bg-opacity, 1));
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 800px;
            text-align: center;
            margin: 40px auto;
        }

        h1 {
            color: #1C4036;
            margin-bottom: 20px;
        }

        .user-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            background-color: #1C4036;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: rgb(75 85 99 / var(--tw-bg-opacity, 1));
        }

        .book-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
        }

        .book-gallery img {
            width: 120px;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            transition: transform 0.3s;
        }

        .book-gallery img:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>مرحباً بك في متجر الكتب</h1>
    
    <div class="user-info">
        <p>مرحباً بك <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
        <p>تم تسجيل دخولك بنجاح.</p>
    </div>

    <h2>بعض من كتبنا المميزة</h2>
    <div class="book-gallery">
        <img src="https://covers.openlibrary.org/b/id/8231856-L.jpg" alt="Book 1">
        <img src="https://covers.openlibrary.org/b/id/10523300-L.jpg" alt="Book 2">
        <img src="https://covers.openlibrary.org/b/id/9871496-L.jpg" alt="Book 3">
        <img src="https://covers.openlibrary.org/b/id/240727-L.jpg" alt="Book 4">
    </div>
    
    <div>
        <a href="index.html" class="button">الصفحة الرئيسية</a>
        <a href="logout.php" class="button">تسجيل الخروج</a>
    </div>
</div>

</body>
</html> 