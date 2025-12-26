<?php
// view.php - Trang hiển thị nội dung (LFI vulnerable)
include 'config.php';

$page = $_GET['page'] ?? 'pages/about.php';

// VULNERABLE: Không kiểm tra tính hợp lệ của đường dẫn file
// Kẻ tấn công có thể dùng ../../ để đọc file hệ thống
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xem nội dung</title>
    <style>
        body { font-family: Arial; line-height: 1.6; }
        .content-box { max-width: 800px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; }
        .menu { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header" style="background: #333; color: white; padding: 10px;">
        <a href="index.php" style="color: white;">Trang Chủ</a>
    </div>

    <div class="content-box">
        <div class="menu">
            <a href="?page=pages/about.php">Giới thiệu</a> | 
            <a href="?page=pages/terms.php">Điều khoản</a>
        </div>
        
        <hr>
        
        <div class="display-area">
            <?php 
                // Thực hiện include file dựa trên tham số GET
                if(file_exists($page)) {
                    include($page); 
                } else {
                    echo "Trang không tồn tại!";
                }
            ?>
        </div>

        <div style="margin-top: 50px; background: #fff3cd; padding: 10px;">
            <p><strong>Lỗ hổng LFI:</strong> Thử thay đổi tham số thành <code>?page=/etc/passwd</code> hoặc dùng PHP Wrappers.</p>
        </div>
    </div>
</body>
</html>
