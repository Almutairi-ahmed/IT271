<?php
// Start session to check for error messages
session_start();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - متجر الكتب</title>
    <style>
        body {
            background-color: rgb(75 85 99 / var(--tw-bg-opacity, 1));;
            font-family: 'Tajawal', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            direction: rtl;
        }

        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 500px;
            
            text-align: center;
        }

        .login-container h2 {
            color: #1C4036;
            margin-bottom: 20px;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container button {
            background-color:  #1C4036;
            color: white;
            border: none;
            padding: 10px;
            width: 30%;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container button:hover {
            background-color: rgb(75 85 99 / var(--tw-bg-opacity, 1));;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            min-height: 20px;
        }
        
        .signup-link {
            margin-top: 20px;
            font-size: 14px;
        }
        
        .signup-link a {
            color: #1C4036;
            text-decoration: none;
            font-weight: bold;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>تسجيل الدخول</h2>
        <form id="login-form" method="post" action="auth.php">
            <input type="hidden" name="action" value="login">
            <input type="email" id="login-email" name="email" placeholder="البريد الإلكتروني" required>
            <input type="password" id="login-password" name="password" placeholder="كلمة المرور" required>
            <button type="submit">دخول</button>
            <?php if(isset($_GET['error']) && $_GET['error'] == 'login') { ?>
                <div class="error">خطأ في اسم المستخدم أو كلمة المرور</div>
            <?php } ?>
            <?php if(isset($_GET['error']) && $_GET['error'] == 'empty') { ?>
                <div class="error">يرجى تعبئة جميع الحقول.</div>
            <?php } ?>
            <div class="signup-link">
                ليس لديك حساب؟ <a href="signuplogin.php">إنشاء حساب جديد</a>
            </div>
        </form>
    </div>

</body>
</html> 