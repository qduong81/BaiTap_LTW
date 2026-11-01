# BaiTap_LTW

# BÀI TẬP CÁ NHÂN BÀI 6: REFACTOR CRUD SANG CẤU TRÚC MVC

## 1. Thông tin chung
- **Họ và tên:** Đào Quang Dương
- **Lớp / Tên đề tài:** Bài tập cá nhân Bài 6 - Quản lý Sản phẩm (MiniShop MVC)

---

## 2. Danh sách các Route thực thi
Mọi request đều đi qua Front Controller (`public/index.php`) và được điều hướng dựa trên tham số `route`:

- `GET  ?route=products`              : Xem danh sách sản phẩm (Client)
- `GET  ?route=admin/products`        : Quản lý danh sách sản phẩm (Admin)
- `GET  ?route=admin/products/create` : Hiển thị form thêm sản phẩm mới
- `POST ?route=admin/products/store`  : Xử lý lưu dữ liệu sản phẩm mới vào CSDL
- `GET  ?route=admin/products/edit`   : Hiển thị form cập nhật thông tin sản phẩm
- `POST ?route=admin/products/update` : Xử lý cập nhật thông tin sản phẩm
- `POST ?route=admin/products/delete` : Xử lý xóa sản phẩm

---

## 3. Báo cáo So sánh Trước và Sau khi Refactor

### Trước khi Refactor (Bài 5)
- **Cấu trúc:** Code xử lý giao diện (HTML), logic điều hướng (PHP) và truy vấn dữ liệu (PDO/SQL) nằm chung trong cùng một file.
- **Nạp file:** Phải gọi `require_once` tệp kết nối CSDL thủ công ở từng file đơn lẻ.
- **Bảo trì:** Khó mở rộng, trùng lặp code và dễ gây lỗi khi chỉnh sửa logic nghiệp vụ hoặc giao diện.

### Sau khi Refactor (Bài 6 - Chuẩn MVC)
- **Tách tầng trách nhiệm rõ ràng:**
  - **Repository (`src/Repository/ProductRepository.php`):** Chịu trách nhiệm duy nhất về dữ liệu và truy vấn MySQL bằng PDO (findAll, findById, create, update, delete, categories).
  - **Controller (`src/Controller/AdminProductController.php` & `ProductController.php`):** Đảm nhận tiếp nhận request, kiểm tra validation dữ liệu đầu vào, điều hướng và gọi Repository.
  - **View (`src/View/admin/product/` & `src/View/product/`):** Chỉ hiển thị giao diện HTML dựa trên dữ liệu Controller truyền sang, tuyệt đối không chứa câu lệnh SQL/PDO.
- **Khởi tạo & Điều hướng tập trung:**
  - Áp dụng **PSR-4 Autoloading** qua Composer (`composer.json` với namespace `App\`) để gọi class tự động mà không cần require thủ công từng file.
  - Sử dụng **Front Controller** (`public/index.php`) làm điểm vào duy nhất cho toàn bộ hệ thống.