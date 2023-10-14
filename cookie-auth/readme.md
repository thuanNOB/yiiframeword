Cookie-Based Authentication (Xác thực dựa trên Cookie) là một phương pháp xác thực người dùng trực tuyến trên các ứng dụng web. Đây là một cách phổ biến để quản lý phiên làm việc của người dùng trên trang web và đảm bảo rằng họ chỉ cần đăng nhập một lần và sau đó duy trì phiên làm việc trong một khoảng thời gian nhất định, thường là một thời gian giới hạn hoặc đến khi người dùng đăng xuất.

Cách hoạt động của Cookie-Based Authentication bao gồm các bước sau:

1. Người dùng đăng nhập: Khi người dùng cung cấp thông tin đăng nhập (ví dụ: tên người dùng và mật khẩu), máy chủ xác thực thông tin này và sau đó tạo một cookie (hoặc nhiều cookie) để đánh dấu phiên làm việc của người dùng.

2. Lưu trữ cookie: Cookie này thường được lưu trên máy tính hoặc thiết bị của người dùng. Nó chứa thông tin về phiên làm việc, chẳng hạn như một mã xác thực ngẫu nhiên.

3. Xác thực tiếp theo: Khi người dùng truy cập các trang hoặc tài nguyên khác trên trang web sau khi đăng nhập, cookie sẽ được gửi cùng với mọi yêu cầu đến máy chủ. Máy chủ sẽ kiểm tra thông tin cookie để xác minh xem người dùng đã đăng nhập hay chưa và có quyền truy cập các tài nguyên đó hay không.

4. Duy trì phiên làm việc: Cookie-Based Authentication giúp duy trì phiên làm việc của người dùng trong một khoảng thời gian nhất định. Nếu người dùng không đăng xuất, họ có thể duy trì phiên làm việc mà không cần phải đăng nhập lại sau mỗi yêu cầu.

5. Đăng xuất: Người dùng có thể đăng xuất bất kỳ lúc nào bằng cách xoá cookie xác thực hoặc thông qua một tùy chọn đăng xuất trên trang web.

Cookie-Based Authentication có lợi thế về tính tiện lợi và khả năng duy trì phiên làm việc của người dùng trong thời gian dài. Tuy nhiên, nó cũng có thể bị tấn công bằng cách đánh cắp cookie hoặc sử dụng kỹ thuật khai thác bảo mật khác. Điều này yêu cầu các biện pháp bảo mật bổ sung để bảo vệ thông tin xác thực của người dùng và đảm bảo tính an toàn của phiên làm việc.

Dưới đây là một ví dụ đơn giản về cách thực hiện Cookie-Based Authentication bằng PHP. Trong ví dụ này, chúng ta sẽ tạo một hệ thống đăng nhập sử dụng cookie để duy trì phiên làm việc của người dùng.

1. **Tạo trang đăng nhập (login.php):**

```php
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <form method="post" action="process_login.php">
        Tên người dùng: <input type="text" name="username"><br>
        Mật khẩu: <input type="password" name="password"><br>
        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>
```

2. **Xử lý đăng nhập (process_login.php):**

```php
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
```

3. **Trang bảng điều khiển (dashboard.php):**

```php
<?php
// Kiểm tra xem người dùng đã đăng nhập bằng cookie hay chưa.
if (isset($_COOKIE['auth_token'])) {
    $auth_token = $_COOKIE['auth_token'];

    // Ở đây, bạn có thể kiểm tra mã xác thực với cơ sở dữ liệu hoặc cách khác để đảm bảo tính hợp lệ của phiên làm việc.

    // Nếu phiên làm việc hợp lệ, hiển thị nội dung của bảng điều khiển.
    echo "Chào mừng đến bảng điều khiển!";
} else {
    header('Location: login.php'); // Chuyển hướng người dùng đến trang đăng nhập nếu chưa đăng nhập.
}
?>
```

Trong ví dụ này, người dùng cung cấp tên người dùng và mật khẩu trong trang đăng nhập. Sau khi đăng nhập thành công, một cookie "auth_token" sẽ được tạo và sử dụng để duy trì phiên làm việc của người dùng. Trang bảng điều khiển kiểm tra sự tồn tại của cookie để xác minh xem người dùng đã đăng nhập hay chưa.

Lưu ý rằng đây chỉ là một ví dụ đơn giản và không phải là một cách an toàn hoàn chỉnh để xác thực người dùng trong thực tế. Trong môi trường thực tế, bạn nên sử dụng các biện pháp bảo mật bổ sung như HTTPS và lưu trữ thông tin xác thực trong cơ sở dữ liệu an toàn.