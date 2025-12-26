<?php
include 'config.php';

$search = $_GET['search'] ?? '';
// VULNERABLE: Có thể bị SQL Injection ở đây nếu muốn
$sql = "SELECT * FROM products";
if(!empty($search)) {
    $sql .= " WHERE name LIKE '%$search%'";
}
$products = $conn->query($sql);

if(isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cửa Hàng Điện Tử</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        .header { background: #333; color: white; padding: 15px 20px; }
        .header a { color: white; text-decoration: none; margin: 0 10px; }
        .container { max-width: 1200px; margin: 20px auto; padding: 0 20px; }
        .products { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .product-card { background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .product-card img { max-width: 100%; height: 150px; object-fit: cover; }
        .search-box { margin: 20px 0; }
        .search-box input { padding: 10px; width: 300px; }
        .search-box button { padding: 10px 20px; background: #007bff; color: white; border: none; }
        .user-info { float: right; }
    </style>
</head>
<body>
    <div class="header">
        <a href="index.php">Trang Chủ</a>
        <a href="profile.php">Hồ Sơ</a>
        <a href="view.php">Thông tin</a>
        <?php if(isset($_SESSION['username'])): ?>
            <div class="user-info">
                Xin chào, <?php echo $_SESSION['username']; ?> | 
                <a href="?logout=1">Đăng xuất</a>
            </div>
        <?php else: ?>
            <a href="login.php">Đăng nhập</a>
            <a href="register.php">Đăng ký</a>
            <a href="view.php">Thông tin</a>
        <?php endif; ?>
    </div>

    <div class="container">
        <h1>Cửa Hàng Điện Tử</h1>
        
        <div class="search-box">
            <form method="GET">
                <input type="text" name="search" placeholder="Tìm sản phẩm..." 
                       value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit">Tìm kiếm</button>
            </form>
        </div>

        <?php if(!empty($search_results)): ?>
            <h2>Kết quả tìm kiếm: "<?php echo $_GET['search']; ?>"</h2>
            <div class="products">
                <?php foreach($search_results as $product): ?>
                    <div class="product-card">
                        <h3><?php echo $product['name']; ?></h3>
                        <p>Giá: <?php echo number_format($product['price']); ?>đ</p>
                        <p>Danh mục: <?php echo $product['category']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h2>Sản phẩm nổi bật</h2>
            <div class="products">
                <?php foreach($products as $product): ?>
                    <div class="product-card">
                        <h3><?php echo $product['name']; ?></h3>
                        <p>Giá: <?php echo number_format($product['price']); ?>đ</p>
                        <p>Danh mục: <?php echo $product['category']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
