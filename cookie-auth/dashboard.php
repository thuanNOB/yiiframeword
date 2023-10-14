<?php
// Kiểm tra xem người dùng đã đăng nhập bằng cookie hay chưa.
if (isset($_COOKIE['auth_token'])) {
    $auth_token = $_COOKIE['auth_token'];

    // Ở đây, bạn có thể kiểm tra mã xác thực với cơ sở dữ liệu hoặc cách khác để đảm bảo tính hợp lệ của phiên làm việc.

    // Nếu phiên làm việc hợp lệ, hiển thị nội dung của bảng điều khiển.
    echo "Chào mừng đến bảng điều khiển!";
} else {
    header('Location: login.html'); // Chuyển hướng người dùng đến trang đăng nhập nếu chưa đăng nhập.
}
?>
