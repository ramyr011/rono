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
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $service_type = trim($_POST["service_type"]);

    if (empty($name) || empty($phone) || empty($email) || empty($service_type)) {
        echo "<script>alert('يرجى ملء جميع الحقول!'); window.history.back();</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('البريد الإلكتروني غير صحيح!'); window.history.back();</script>";
        exit();
    }
0
    $stmt = $conn->prepare("INSERT INTO bookings (name, phone, email, service_type) VALUES (:name, :phone, :email, :service_type)");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":service_type", $service_type);

    if ($stmt->execute()) {
        echo "<script>alert('تم حجز الموعد بنجاح! سيتم التواصل معك قريبًا.'); window.location.href='booking.html';</script>";
    } else {
        echo "<script>alert('حدث خطأ أثناء الحجز، يرجى المحاولة مرة أخرى.'); window.history.back();</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حجز موعد صيانة</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<form action="booking.php" method="POST">
    <input type="text" name="name" placeholder="اسمك الكريم" required>
    <input type="tel" name="phone" placeholder="رقم الجوال" required>
    <input type="email" name="email" placeholder="البريد الإلكتروني" required>
    <select name="service_type" required>
        <option value="">نوع الخدمة المطلوبة</option>
        <option value="صيانة دورية">صيانة دورية</option>
        <option value="إصلاح عطل">إصلاح عطل</option>
        <option value="فحص شامل">فحص شامل</option>
    </select>
    <button type="submit" class="btn btn-large">حجز الموعد</button>
</form>

</body>
</html>