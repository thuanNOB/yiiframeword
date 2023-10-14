<?php
// Xác thực tên người dùng và mật khẩu (trong thực tế, bạn sẽ kiểm tra cơ sở dữ liệu hoặc hệ thống xác thực khác).
$username = $_POST['username'];
$password = $_POST['password'];

// Kiểm tra thông tin đăng nhập và tạo cookie nếu hợp lệ.
if ($username === 'nguoidung' && $password === 'matkhau') {
    $auth_token = md5($username . $password); // Tạo một mã xác thực ngẫu nhiên.

    // Lưu mã xác thực vào cookie và thiết lập thời gian sống cho cookie.
    setcookie('auth_token', $auth_token, time() + 3600, '/'); // Thời gian sống: 1 giờ.

    header('Location: dashboard.php'); // Chuyển hướng người dùng sau khi đăng nhập thành công.
} else {
    echo "Đăng nhập không hợp lệ. Vui lòng thử lại.";
}
?>
