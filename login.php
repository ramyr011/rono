<?php
session_start(); 
$host = "localhost";
$dbname = "car_dealership";
$username = "root";  
$password = "";  

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        echo "<script>alert('يرجى ملء جميع الحقول!'); window.history.back();</script>";
        exit();
    }

    // البحث عن المستخدم في قاعدة البيانات
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_email"] = $user["email"];
        echo "<script>alert('تم تسجيل الدخول بنجاح!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('البريد الإلكتروني أو كلمة المرور غير صحيحة!'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="login.php" method="POST">
    <div class="form-group">
        <label for="email">البريد الإلكتروني</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">كلمة المرور</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="form-options">
        <label>
            <input type="checkbox"> تذكرني
        </label>
    </div>
    <button type="submit" class="btn btn-large">تسجيل الدخول</button>
</form>

</body>
</html>