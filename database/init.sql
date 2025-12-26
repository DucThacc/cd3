CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50),
    full_name VARCHAR(100),
    role VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(15, 2),
    category VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT
);

INSERT INTO users (username, password, full_name, role) VALUES 
('admin', 'admin123', 'Quản trị viên', 'admin'),
('customer1', '123456', 'Nguyễn Văn A', 'customer'),
('customer2', 'password', 'Trần Thị B', 'customer');

INSERT INTO products (name, price, category) VALUES 
('iPhone 15', 15000000, 'điện thoại'),
('MacBook Pro', 35000000, 'laptop'),
('AirPods Pro', 5000000, 'phụ kiện'),
('Samsung Galaxy S23', 12000000, 'điện thoại');

INSERT INTO reports (id, content) VALUES 
(1, 'Báo cáo doanh số tháng 12: 1 tỷ VND'),
(2, 'Danh sách người dùng nhạy cảm: admin, customer1...'),
(3, 'Kế hoạch kinh doanh năm 2026');
