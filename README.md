# Snikei Shop

Ứng dụng web bán giày theo mô hình **MVC** (PHP thuần), bao gồm khu vực người dùng và trang quản trị viên.

## Công Nghệ Sử Dụng

- **PHP 8+**
- **MySQL / MariaDB**
- **Composer** (PSR-4 autoload)
- **HTML5 / CSS3 / JavaScript**
- **XAMPP** (khuyến nghị để chạy local)

## Cấu Trúc Thư Mục

```text
snikei_shop/
├── app/
│   ├── controllers/        # Các controller xử lý logic
│   ├── models/            # Các model tương tác database
│   ├── views/             # Các view hiển thị giao diện
│   └── Core/
├── config/
│   └── config.php         # Cấu hình ứng dụng
├── public/
│   ├── index.php          # Entry point
│   ├── assets/            # CSS, JS, Images
│   └── uploads/           # Thư mục upload file
├── vendor/                # Dependencies từ Composer
├── composer.json
└── README.md
```

## Cài Đặt Nhanh (XAMPP)

### Yêu Cầu

- XAMPP (hoặc server PHP local khác)
- Composer đã cài đặt

### Các Bước Cài Đặt

1. **Đặt project vào thư mục:**

   ```bash
   C:/xampp/htdocs/snikei_shop
   ```

2. **Khởi động XAMPP:**
   - Mở XAMPP Control Panel
   - Nhấn "Start" cho Apache
   - Nhấn "Start" cho MySQL

3. **Tạo database:**
   - Mở phpMyAdmin: `http://localhost/phpmyadmin`
   - Tạo database mới với tên `snikei`

4. **Import database:**
   - Chọn database `snikei`
   - Vào tab "Import"
   - Chọn file `snikei_shop.sql`
   - Nhấn "Import"

5. **Cài đặt dependencies:**

   ```bash
   composer install
   ```

6. **Truy cập ứng dụng:**
   ```
   http://localhost/snikei_shop/public/
   ```

## Cấu Hình Database

Ứng dụng sử dụng cấu hình kết nối trong `app/models/Database.php`:

| Tham số  | Giá trị mặc định |
| -------- | ---------------- |
| Host     | `localhost`      |
| Database | `snikei`         |
| User     | `root`           |
| Password | `123456`         |

**Lưu ý:** Nếu máy tính của bạn sử dụng thông tin khác, hãy sửa trực tiếp file `app/models/Database.php`.

## Tính Năng Chính

### Frontend - Khu Vực Người Dùng

- 🏠 Trang chủ
- 🔐 Đăng nhập / Đăng ký / Đăng xuất
- 📁 Danh mục sản phẩm
- 🛍️ Shop + Chi tiết sản phẩm
- 🛒 Giỏ hàng + Thanh toán
- ⭐ Đánh giá sản phẩm
- 📧 Trang liên hệ
- 📰 Blog
- 👤 Trang hồ sơ

### Backend - Khu Vực Quản Trị

- 📊 Dashboard
- 📦 Quản lý sản phẩm (thêm, sửa, xóa)
- 👥 Danh sách khách hàng
- 💬 Danh sách tin nhắn
- 📋 Quản lý đơn hàng
- 📈 Overview doanh số
- 🧾 Hóa đơn
- 💳 Quản lý thanh toán
- 📅 Lịch sự kiện
- 🔖 Quản lý thuế

## Các Route Chính

### 🌐 Route Công Khai

| Route           | Mô Tả             |
| --------------- | ----------------- |
| `/`             | Trang chủ         |
| `/login`        | Đăng nhập         |
| `/register`     | Đăng ký tài khoản |
| `/contact`      | Liên hệ           |
| `/about`        | Giới thiệu        |
| `/blog`         | Blog              |
| `/categories`   | Danh mục sản phẩm |
| `/shop`         | Cửa hàng          |
| `/shop?id={id}` | Chi tiết sản phẩm |
| `/checkout`     | Thanh toán        |

### ⚙️ Route Xử Lý Form

| Route               | Chức Năng              |
| ------------------- | ---------------------- |
| `/process_login`    | Xử lý đăng nhập        |
| `/process_register` | Xử lý đăng ký          |
| `/process_contact`  | Xử lý tin nhắn liên hệ |
| `/process_addcart`  | Thêm sản phẩm vào giỏ  |

### 🔒 Route Admin (Cần xác thực)

| Route              | Chức Năng          |
| ------------------ | ------------------ |
| `/admin/dashboard` | Dashboard quản trị |
| `/admin/products`  | Quản lý sản phẩm   |
| `/admin/customers` | Quản lý khách hàng |
| `/admin/orders`    | Quản lý đơn hàng   |
| `/admin/messages`  | Quản lý tin nhắn   |

## Hướng Dẫn Phát Triển

### Thêm Controller Mới

1. Tạo file mới trong `app/controllers/`
2. Extend từ class `Controller`
3. Định nghĩa các method public

```php
<?php
namespace App\Controllers;

use App\Core\Controller;

class MyController extends Controller {
    public function index() {
        $this->view('my_view', ['data' => 'value']);
    }
}
```

### Thêm Model Mới

1. Tạo file mới trong `app/models/`
2. Extend từ class `Database`
3. Định nghĩa các method truy vấn

```php
<?php
namespace App\Models;

use App\Models\Database;

class MyModel extends Database {
    public function getAllRecords() {
        return $this->db->query("SELECT * FROM table")->fetchAll();
    }
}
```

## Bảo Mật

- ✅ Kiểm tra session trước khi truy cập khu vực admin
- ✅ Sử dụng prepared statements để tránh SQL injection
- ✅ Validate và sanitize dữ liệu từ form
- ✅ Mã hóa mật khẩu sử dụng `password_hash()`

## Tác Giả & Đóng Góp

**Tác Giả:** Snikei Team

Nếu bạn muốn đóng góp, vui lòng:

1. Fork project
2. Tạo branch feature mới (`git checkout -b feature/AmazingFeature`)
3. Commit thay đổi (`git commit -m 'Add some AmazingFeature'`)
4. Push lên branch (`git push origin feature/AmazingFeature`)
5. Mở Pull Request

## Giấy Phép

Dự án này được cấp phép theo **MIT License**.

## Liên Hệ & Hỗ Trợ

- 📧 Email: support@snikei.com
- 🌐 Website: https://snikei.com
- 📱 Hotline: 0123-456-789

---

**Lần cập nhật cuối:** May 2026

- `/process_add_review`
- `/logout`

### Admin

- `/admin/dashboard`
- `/admin/products`
- `/admin/product_add`
- `/admin/edit_product?id={id}`
- `/admin/delete_product?id={id}`
- `/admin/customers`
- `/admin/messages`
- `/admin/overview`

## Ghi chu

- Front controller nam o `public/index.php`.
- Project dung session de xac thuc.
- Cac route admin yeu cau tai khoan co role `admin`.
