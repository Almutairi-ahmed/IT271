<?php
// Start session to check for error messages
session_start();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الدخول / إنشاء حساب - متجر الكتب</title>
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
      width: 500px;
      text-align: center;
      margin: 40px auto 20px auto;
    }

    .tabs {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .tab-button {
      background-color: #e0e0e0;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      font-weight: bold;
      color: #333;
      margin: 0 5px;
      border-radius: 5px;
    }

    .tab-button.active {
      background-color: #1C4036;
      color: white;
    }

    form {
      display: none;
    }

    form.active {
      display: block;
    }

    input {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button[type="submit"] {
      background-color: #1C4036;
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

    button[type="submit"]:hover {
      background-color: rgb(75 85 99 / var(--tw-bg-opacity, 1));
    }

    .error {
      color: red;
      font-size: 14px;
      margin-top: 10px;
    }

    .book-gallery {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
      max-width: 1000px;
      margin: 0 auto 40px;
      padding: 20px;
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

    h3.section-title {
      text-align: center;
      color: white;
      margin-top: 40px;
      font-size: 24px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="tabs">
    <button class="tab-button active" onclick="showTab('login')">تسجيل الدخول</button>
    <button class="tab-button" onclick="showTab('signup')">إنشاء حساب</button>
  </div>

  <!-- نموذج تسجيل الدخول -->
  <form id="login" method="post" action="auth.php" class="active">
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
  </form>

  <!-- نموذج إنشاء حساب -->
  <form id="signup" method="post" action="auth.php">
    <input type="hidden" name="action" value="register">
    <input type="text" id="signup-name" name="name" placeholder="الاسم الكامل" required>
    <input type="email" id="signup-email" name="email" placeholder="البريد الإلكتروني" required>
    <input type="password" id="signup-password" name="password" placeholder="كلمة المرور" required>
    <input type="password" id="signup-confirm" name="confirm" placeholder="تأكيد كلمة المرور" required>
    <button type="submit" onclick="return validatePassword()">تسجيل</button>
    <?php if(isset($_GET['error']) && $_GET['error'] == 'register') { ?>
      <div class="error">هذا البريد الإلكتروني مسجل بالفعل</div>
    <?php } ?>
    <?php if(isset($_GET['error']) && $_GET['error'] == 'password_mismatch') { ?>
      <div class="error">كلمتا المرور غير متطابقتين.</div>
    <?php } ?>
    <?php if(isset($_GET['error']) && $_GET['error'] == 'db_error') { ?>
      <div class="error">حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.</div>
    <?php } ?>
    <div id="signup-error" class="error"></div>
  </form>
</div>

<h3 class="section-title">بعض من كتبنا المميزة</h3>

<div class="book-gallery">
  <img src="https://covers.openlibrary.org/b/id/8231856-L.jpg" alt="Book 1">
  <img src="https://covers.openlibrary.org/b/id/10523300-L.jpg" alt="Book 2">
  <img src="https://covers.openlibrary.org/b/id/9871496-L.jpg" alt="Book 3">
  <img src="https://covers.openlibrary.org/b/id/240727-L.jpg" alt="Book 4">
  <img src="https://covers.openlibrary.org/b/id/5546156-L.jpg" alt="Book 5">
</div>

<script>
  // Show tab function
  function showTab(tabId) {
    document.querySelectorAll('form').forEach(form => form.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');

    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
    event.currentTarget.classList.add('active');
  }

  // Make forms visible by default
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('login').classList.add('active');
  });

  // Function to validate password match
  function validatePassword() {
    const password = document.getElementById("signup-password").value;
    const confirm = document.getElementById("signup-confirm").value;
    const error = document.getElementById("signup-error");
    
    if (password !== confirm) {
      error.textContent = "كلمتا المرور غير متطابقتين.";
      return false;
    }
    return true;
  }
</script>

</body>
</html> 