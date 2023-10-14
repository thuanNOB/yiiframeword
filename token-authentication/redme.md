Token authentication là gì ?

Token Authentication là một phương thức xác thực người dùng trên internet bằng cách sử dụng các token (mã thông báo) thay vì tên người dùng và mật khẩu. Token được tạo và gửi từ máy chủ xác thực cho người dùng sau khi họ xác thực thành công. Người dùng sau đó sử dụng token này để truy cập tài khoản hoặc tài nguyên của họ. Phương thức này thường được sử dụng để tăng tính bảo mật và đơn giản hóa quá trình xác thực.

Cách Token Authentication hoạt động:

1. Người dùng cung cấp thông tin xác thực (thường là tên người dùng và mật khẩu) cho máy chủ xác thực.

2. Sau khi xác thực thành công, máy chủ xác thực tạo một token đặc biệt và ký nó bằng một khóa riêng (private key) để đảm bảo tính toàn vẹn của nó. Token này thường chứa thông tin về người dùng, quyền hạn, và thời hạn hiệu lực.

3. Token được trả về cho người dùng.

4. Người dùng sử dụng token này khi gửi yêu cầu đến máy chủ ứng dụng hoặc tài nguyên được bảo vệ. Token được đính kèm trong header của yêu cầu HTTP.

5. Máy chủ ứng dụng hoặc tài nguyên xác minh tính hợp lệ của token bằng cách kiểm tra chữ ký số học (digital signature) bằng khóa công khai (public key) của máy chủ xác thực. Nếu token hợp lệ và chưa hết hạn, máy chủ cho phép người dùng truy cập tài khoản hoặc tài nguyên.

Một số ưu điểm của Token Authentication bao gồm:

- **Bảo mật cao**: Token không lộ thông tin xác thực thô (như tên người dùng và mật khẩu) và được mã hóa và ký số học. Điều này làm giảm nguy cơ bị đánh cắp thông tin xác thực.

- **Quản lý quyền hạn**: Token thường chứa thông tin về quyền hạn của người dùng, cho phép máy chủ quản lý quyền truy cập một cách linh hoạt.

- **Thời hạn**: Token có thể có thời hạn, nghĩa là nó sẽ tự động hết hạn sau một khoảng thời gian, đảm bảo tính bảo mật và an toàn.

- **Tích hợp dễ dàng**: Token Authentication thích hợp cho các ứng dụng web và di động và có thể tích hợp với các dịch vụ bên ngoài dễ dàng.

Token Authentication thường được sử dụng trong các ứng dụng web, dịch vụ web API, và các hệ thống xác thực phân tán.



Dưới đây là một ví dụ đơn giản về cách sử dụng Token Authentication bằng PHP để bảo vệ một API đơn giản. Chúng ta sẽ sử dụng JSON Web Tokens (JWT) để tạo và xác thực token.

1. **Cài đặt thư viện JWT cho PHP:**

   Đầu tiên, bạn cần cài đặt thư viện JWT cho PHP. Bạn có thể sử dụng Composer để làm điều này. Thêm dòng sau vào tệp `composer.json` của bạn:

   ```json
   "require": {
       "firebase/php-jwt": "^5.4"
   }
   ```

   Sau đó chạy lệnh `composer install` để cài đặt thư viện.

2. **Tạo tệp PHP cho ví dụ Token Authentication:**

Dưới đây là ví dụ về cách tạo và xác thực JWT để bảo vệ một API đơn giản:

```php
<?php
require 'vendor/autoload.php';

use \Firebase\JWT\JWT;

// Thay đổi đoạn mã này bằng khóa bí mật thực sự của bạn
$secret_key = 'your_secret_key';

// Hàm để tạo JWT token
function generateToken($data) {
    global $secret_key;
    $token = array(
        "data" => $data,
        "iat" => time(),         // Thời điểm phát hành (issued at)
        "exp" => time() + 3600   // Thời hạn của token (1 giờ)
    );
    return JWT::encode($token, $secret_key);
}

// Hàm để kiểm tra và giải mã JWT token
function verifyToken($token) {
    global $secret_key;
    try {
        $decoded = JWT::decode($token, $secret_key, array('HS256'));
        return $decoded->data;
    } catch (Exception $e) {
        return null;
    }
}

// Xác thực tài khoản và tạo token
$username = "user123";
$password = "password123";

// Kiểm tra tên người dùng và mật khẩu ở đây (điều này chỉ là một ví dụ đơn giản)
if ($username === "user123" && $password === "password123") {
    $user_data = array("username" => $username, "email" => "user123@example.com");
    $token = generateToken($user_data);
    echo "Token: " . $token;
} else {
    echo "Xác thực không hợp lệ";
}

// Xác thực token và truy cập tài nguyên bảo vệ
$token_from_client = "YOUR_TOKEN_HERE"; // Thay đổi thành token từ phía người dùng

$user_data = verifyToken($token_from_client);
if ($user_data !== null) {
    echo "Chào mừng " . $user_data->username;
} else {
    echo "Token không hợp lệ";
}
```

Trong ví dụ này:

- Chúng ta sử dụng thư viện JWT để tạo và xác thực token.
- Một token JWT được tạo khi người dùng xác thực thành công. Token này chứa thông tin về người dùng, thời điểm phát hành và thời hạn của token.
- Sau đó, chúng ta xác thực token từ phía người dùng để truy cập tài nguyên bảo vệ.

Lưu ý rằng trong thực tế, bạn nên lưu trữ khóa bí mật và thực hiện kiểm tra tên người dùng và mật khẩu dựa trên cơ sở dữ liệu hoặc hệ thống xác thực phức tạp hơn.