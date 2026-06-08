# Snikei Shop

Snikei Shop là một ứng dụng web bán giày nhỏ, xây dựng theo mô hình MVC bằng PHP thuần. Bao gồm khu vực người dùng (shop, giỏ hàng, thanh toán, blog, hồ sơ...) và khu vực quản trị để quản lý sản phẩm, đơn hàng và khách hàng.

## Tổng quan nhanh
- Ngôn ngữ: PHP (PHP 8+)
- Database: MySQL / MariaDB
- Dependency: Composer (PSR-4)
- Chạy local: XAMPP / WAMP / PHP built-in server

## Tính năng chính
- Trang chủ, danh mục, trang shop và chi tiết sản phẩm
- Đăng ký / đăng nhập / hồ sơ người dùng
- Giỏ hàng, thanh toán (QR/checkout)
- Đánh giá sản phẩm, liên hệ, blog
- Khu vực Admin: dashboard, quản lý sản phẩm, khách hàng, đơn hàng, tin nhắn, coupons, thuế

## Yêu cầu
- PHP 8+
- MySQL hoặc MariaDB
- Composer
- Web server (Apache trong XAMPP recommended)

## Cách cài đặt (chạy local)
1. Sao chép project vào thư mục web server, ví dụ `C:/xampp/htdocs/snikei_shop`.
2. Khởi động Apache và MySQL (XAMPP Control Panel).
3. Tạo database mới (ví dụ tên `snikei`) trong phpMyAdmin.
4. Import file SQL cung cấp (ví dụ `snikei_shop.sql`) vào database vừa tạo.
5. Cài dependencies (nếu cần):

```bash
composer install
```

6. Cấu hình kết nối database: chỉnh thông tin trong `app/models/Database.php` hoặc `config/config.php` (tùy cấu trúc):

- Host: `localhost`
- Database: `snikei` (hoặc tên bạn tạo)
- User: `root`
- Password: (để trống hoặc theo cấu hình của bạn)

7. Mở trình duyệt tới:

```
http://localhost/snikei_shop/public/
```

## Cấu trúc thư mục (tóm tắt)

- `app/controllers/` — Controllers
- `app/models/` — Models (kết nối DB và truy vấn)
- `app/views/` — Views (giao diện)
- `public/` — Entry point (`index.php`), assets, uploads
- `config/` — Cấu hình ứng dụng
- `vendor/` — Thư viện Composer

## Thông tin cấu hình quan trọng
- Front controller: `public/index.php`
- Kiểm tra/đổi cấu hình DB tại `app/models/Database.php` hoặc `config/config.php` nếu dự án sử dụng file cấu hình tách biệt.

## Phát triển & Ghi nhớ
- Thêm controller: tạo file trong `app/controllers/` và extend từ `App\\Core\\Controller`.
- Thêm model: tạo file trong `app/models/` và sử dụng kết nối DB có sẵn.
- Luôn validate và sanitize dữ liệu đầu vào; sử dụng prepared statements để tránh SQL injection.

Ví dụ nhanh controller:

```php
<?php
namespace App\\Controllers;
use App\\Core\\Controller;

class MyController extends Controller {
   public function index() {
      $this->view('my_view', ['data' => 'value']);
   }
}
```

## Routes cơ bản
- `/` — Trang chủ
- `/login`, `/register`, `/logout` — Xác thực
- `/shop`, `/shop?id={id}` — Danh sách / chi tiết sản phẩm
- `/contact`, `/about`, `/blog`
- Các route admin nằm dưới `/admin/*` (yêu cầu quyền admin)

## Bảo mật
- Kiểm tra session trước khi truy cập khu vực admin
- Mã hóa mật khẩu bằng `password_hash()`
- Sử dụng prepared statements / parameterized queries

## Đóng góp
1. Fork repository
2. Tạo branch feature: `git checkout -b feature/your-feature`
3. Commit và push
4. Mở Pull Request mô tả thay đổi

## License
Dự án được cấp phép theo MIT License.

## Liên hệ
- Email: support@snikei.com

---

Nếu bạn muốn, tôi có thể:

- Thêm hướng dẫn chi tiết cài đặt database (đường dẫn file .sql)
- Viết hướng dẫn deploy lên server (Apache/nginx)
- Dịch sang tiếng Anh

Cho tôi biết bạn muốn bổ sung gì nữa nhé.
