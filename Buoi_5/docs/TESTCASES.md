# Danh Sách 5 Test Cases Kiểm Thử Chức Năng (Bảng Products)


| **TC01** | Tìm kiếm sản phẩm có tồn tại | Nhập từ khóa: `Kingston` vào ô tìm kiếm và bấm **Tìm kiếm** | Danh sách hiển thị đúng 1 sản phẩm: "USB Kingston 32GB". | **ĐÚNG (Valid)** |
| **TC02** | Tìm kiếm từ khóa không có trong CSDL | Nhập từ khóa: `ABCXYZ123` | Hệ thống báo dòng chữ: "Không tìm thấy sản phẩm nào." | **ĐÚNG (Valid)** |
| **TC03** | Chuyển trang qua thanh phân trang | Click vào nút trang **`2`** trên URL (`page=2`) | Hệ thống dùng `LIMIT/OFFSET` để lấy đúng danh sách sản phẩm ở trang 2. | **ĐÚNG (Valid)** |
| **TC04** | Nhập số trang âm hoặc không hợp lệ | Thay đổi URL thành `products.php?page=-5` | Đã có hàm `max(1, page)` nên hệ thống tự động về trang `1`, không bị văng lỗi PHP/SQL. | **SAI (Invalid)** |
| **TC05** | Xóa sản phẩm khỏi hệ thống qua POST | Bấm nút **Xóa** ở sản phẩm `id=5` và bấm **OK** xác nhận | Gửi dữ liệu bằng phương thức `POST`, xóa thành công bản ghi khỏi CSDL và quay lại trang danh sách. | **ĐÚNG (Valid)** |