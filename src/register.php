<?php
// register.php - Trang đăng ký (Vulnerable to SQL Injection)
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'customer'; // Mặc định đăng ký là khách hàng

    // VULNERABLE: Lỗ hổng SQL Injection tại câu lệnh INSERT
    $sql = "INSERT INTO users (username, password, full_name, role) 
            VALUES ('$username', '$password', '$full_name', '$role')";

    if ($conn->query($sql) === TRUE) {
        $message = "Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a>";
    } else {
        $message = "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; }
        .register-box { max-width: 400px; margin: 50px auto; background: white; padding: 30px; border-radius: 5px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; cursor: pointer; }
        .message { margin-bottom: 15px; padding: 10px; border-radius: 3px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Đăng ký thành viên</h2>
        
        <?php if($message): ?>
            <div class="message <?php echo strpos($message, 'thành công') ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="full_name" placeholder="Họ và tên" required>
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng ký</button>
        </form>
        <p style="text-align: center;"><a href="login.php">Đã có tài khoản? Đăng nhập</a></p>
        <p style="text-align: center;"><a href="index.php">Về trang chủ</a></p>
    </div>
</body>
</html>
