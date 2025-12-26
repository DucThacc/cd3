<?php
include 'config.php';

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

$report_id = $_GET['id'] ?? 1;
// VULNERABLE: IDOR - Không kiểm tra quyền sở hữu report
$sql = "SELECT * FROM reports WHERE id = $report_id";
$result = $conn->query($sql);
$report = $result->fetch_assoc();

$report_content = $report['content'] ?? 'Báo cáo không tồn tại';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản trị</title>
</head>
<body>
    <div class="header">
        <a href="index.php">Trang Chủ</a>
        <a href="profile.php">Hồ Sơ</a>
        <div style="float:right">Xin chào, <?php echo $_SESSION['name']; ?></div>
    </div>

    <div style="max-width: 800px; margin: 30px auto;">
        <h1>Trang quản trị</h1>
        
        <h2>Báo cáo #<?php echo $report_id; ?></h2>
        <div style="background: #f9f9f9; padding: 20px;">
            <?php echo $report_content; ?>
        </div>
        
        <div style="margin-top: 30px;">
            <h3>IDOR Demo:</h3>
            <p>Thử thay đổi ID trong URL:</p>
            <p><a href="?id=1">Báo cáo 1</a> | <a href="?id=2">Báo cáo 2</a> | <a href="?id=3">Báo cáo 3</a></p>
            <p><small>Lỗ hổng: Có thể truy cập báo cáo không được phép bằng cách thay đổi ID</small></p>
        </div>
    </div>
</body>
</html>
