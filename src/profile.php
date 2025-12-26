<?php
// profile.php - Trang hồ sơ cá nhân
include 'config.php';

if(!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Xử lý upload avatar
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar'])) {
    $file_name = $_FILES['avatar']['name'];
    $file_tmp = $_FILES['avatar']['tmp_name'];
    
    // Không kiểm tra loại file - Lỗ hổng upload
    $upload_path = 'uploads/' . $file_name;
    
    if(move_uploaded_file($file_tmp, $upload_path)) {
        $message = "Upload avatar thành công!";
    } else {
        $message = "Upload thất bại!";
    }
}

// Lấy thông tin user (giả lập)
$user_info = $users[$_SESSION['username']] ?? null;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hồ sơ cá nhân</title>
    <style>
        body { font-family: Arial; }
        .profile-container { max-width: 600px; margin: 50px auto; }
        .profile-info { background: white; padding: 20px; }
        .upload-form { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <a href="index.php">Trang Chủ</a>
        <a href="profile.php">Hồ Sơ</a>
        <div style="float:right">
            Xin chào, <?php echo $_SESSION['name']; ?> | 
            <a href="?logout=1">Đăng xuất</a>
        </div>
    </div>

    <div class="profile-container">
        <h1>Hồ sơ cá nhân</h1>
        
        <?php if(isset($message)): ?>
            <p style="color:green"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <div class="profile-info">
            <p><strong>Tên đăng nhập:</strong> <?php echo $_SESSION['username']; ?></p>
            <p><strong>Họ tên:</strong> <?php echo $_SESSION['name']; ?></p>
            <p><strong>Vai trò:</strong> <?php echo $_SESSION['role']; ?></p>
            
            <div class="upload-form">
                <h3>Upload avatar</h3>
                <form method="POST" enctype="multipart/form-data">
                    <input type="file" name="avatar" required>
                    <button type="submit">Upload</button>
                </form>
                <p><small>Lỗ hổng: Có thể upload file PHP, shell</small></p>
            </div>
            
            <?php if($_SESSION['role'] == 'admin'): ?>
                <div style="margin-top: 30px; padding: 15px; background: #f0f0f0;">
                    <h3>Khu vực quản trị</h3>
                    <p><a href="admin.php?id=1">Xem báo cáo</a></p>
                    <p><a href="admin.php?id=2">Quản lý người dùng</a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
