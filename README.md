# 🎬 HỆ THỐNG QUẢN LÝ STUDIO (STUDIO MANAGEMENT SYSTEM)

## 👥 PHÂN CÔNG NHIỆM VỤ & QUẢN LÝ THƯ MỤC CÁ NHÂN

> 📌 **QUY TẮC CẤU TRÚC THƯ MỤC CÁ NHÂN:**
> * Mỗi thành viên tự quản lý toàn bộ file `.php`, file style `.css`, và script `.js` phục vụ cho tính năng của mình **ngay trong chính thư mục `PERSON_X/`**.
> * Nhúng CSS/JS cá nhân vào file PHP bằng đường dẫn tương đối (Ví dụ: `<link rel="stylesheet" href="style.css">` hoặc `<script src="script.js"></script>`).

---

### 🔴 NGƯỜI A – Layout Chung, Trang Chủ, Tìm Kiếm & Admin
> 📁 **Thư mục code cá nhân:** `PERSON_A/`  
> 📁 **File giao diện chung phụ trách:** `includes/header.php`, `includes/footer.php`, `assets/css/common.css`

- [ ] **1. Layout Dùng Chung (Common UI)** `includes/` & `assets/css/common.css`
  - [ ] `header.php`: Navigation bar chuyển đổi theo vai trò (`Guest`, `Customer`, `Vendor`, `Admin`).
  - [ ] `footer.php`: Footer thông tin liên hệ và bản quyền.
  - [ ] `common.css`: Style khung layout chung (Font chữ, màu chủ đạo, Reset CSS).
  - [ ] Toast/Modal thông báo dùng chung.
- [ ] **2. Trang Chủ (Home)** `PERSON_A/index.php` (dùng `PERSON_A/home.css`, `PERSON_A/home.js`)
  - [ ] Banner giới thiệu hệ thống studio.
  - [ ] Danh sách dịch vụ nổi bật/mới nhất.
  - [ ] Ô tìm kiếm nhanh theo từ khóa.
- [ ] **3. Tìm Kiếm & Lọc (Search & Filter)** `PERSON_A/search.php`
  - [ ] Trang kết quả tìm kiếm.
  - [ ] Bộ lọc nâng cao: Loại dịch vụ, Khoảng giá, Ngày trống.
- [ ] **4. Quản Trị Hệ Thống (Admin)** `PERSON_A/admin/`
  - [ ] Trang đăng nhập Admin / phân quyền `role = 'admin'`.
  - [ ] `vendor-approval.php`: Danh sách & Nút Duyệt / Từ chối tài khoản Vendor mới.
  - [ ] `user-management.php`: Danh sách toàn bộ User, Nút Khóa / Mở tài khoản.
  - [ ] `dashboard.php`: Dashboard thống kê doanh thu, tổng đơn, biểu đồ.

---

### 🔵 NGƯỜI B – Quản Lý Dịch Vụ (Studio, Thợ Chụp, Thiết Bị, Trang Phục, Đạo Cụ)
> 📁 **Thư mục code cá nhân:** `PERSON_B/` (Chứa các file `.php`, `person_b.css`, `person_b.js`)

- [ ] **1. Phía Khách Hàng Xem (Customer View)** `PERSON_B/`
  - [ ] `services.php`: Danh sách dịch vụ (Tab chuyển đổi giữa các loại dịch vụ).
  - [ ] `service-detail.php`: Chi tiết dịch vụ (Slide ảnh, Mô tả, Chi tiết giá, Đánh giá).
  - [ ] Hiển thị lịch trống real-time của dịch vụ theo Ngày/Giờ.
- [ ] **2. Phía Chủ Dịch Vụ Quản Lý (Vendor Management)** `PERSON_B/vendor/`
  - [ ] `my-services.php`: Danh sách dịch vụ cá nhân đã đăng.
  - [ ] `service-add.php`: Form thêm mới dịch vụ.
  - [ ] `service-edit.php`: Sửa / Xóa / Ẩn dịch vụ.
  - [ ] Upload một hoặc nhiều ảnh sản phẩm/dịch vụ lên thư mục `assets/uploads/`.
  - [ ] `schedule-manage.php`: Thiết lập & Quản lý lịch trống nhận khách.

---

### 🟢 NGƯỜI C – Giỏ Hàng, Đặt Lịch & Thanh Toán
> 📁 **Thư mục code cá nhân:** `PERSON_C/` (Chứa các file `.php`, `person_c.css`, `person_c.js`)

- [ ] **1. Giỏ Hàng (Cart)** `PERSON_C/cart.php`
  - [ ] Nút "Thêm vào giỏ" trên trang chi tiết (Lưu Ngày, Giờ, Số lượng vào `$_SESSION['cart']`).
  - [ ] Trang giỏ hàng tổng hợp: Chỉnh sửa Ngày/Giờ/Số lượng, Tự động tính tổng tiền.
  - [ ] **Logic kiểm tra trùng lịch (Overlap Checking):** Ngăn không cho thêm/đặt nếu khung giờ đã bị giữ.
- [ ] **2. Đặt Lịch & Thanh Toán (Checkout & Payment)** `PERSON_C/checkout.php`
  - [ ] Trang xác nhận thông tin người đặt và ghi chú.
  - [ ] Lưu đơn hàng vào MySQL & Đánh dấu khung giờ bị khóa.
  - [ ] `payment.php`: Giả lập thanh toán (Chuyển khoản QR code / Tiền mặt).
- [ ] **3. Phía Vendor Xử Lý Đơn (Vendor Order Processing)** `PERSON_C/vendor-orders.php`
  - [ ] Danh sách đơn hàng thuộc dịch vụ của Vendor.
  - [ ] Thao tác bấm Duyệt (Xác nhận) / Từ chối đơn đặt.

---

### 🟡 NGƯỜI D – Tài Khoản, Lịch Sử & Đánh Giá
> 📁 **Thư mục code cá nhân:** `PERSON_D/` (Chứa các file `.php`, `person_d.css`, `person_d.js`)

- [ ] **1. Xác Thực & Phân Quyền (Authentication)** `PERSON_D/`
  - [ ] `register.php`: Trang Đăng ký (Tùy chọn vai trò: Khách hàng / Vendor).
  - [ ] `login.php`: Trang Đăng nhập (Kiểm tra xem Vendor đã được Admin duyệt chưa).
  - [ ] `logout.php`: Đăng xuất và xóa Session.
- [ ] **2. Quản Lý Hồ Sơ (Profile)** `PERSON_D/profile.php`
  - [ ] Xem & Sửa thông tin cá nhân.
  - [ ] Chức năng Đổi mật khẩu.
- [ ] **3. Phía Khách Hàng (Customer Orders & Reviews)** `PERSON_D/`
  - [ ] `my-orders.php`: Quản lý đơn cá nhân, theo dõi trạng thái đơn.
  - [ ] `order-detail.php`: Xem chi tiết đơn đã đặt.
  - [ ] `review.php`: Nút Đánh giá xuất hiện sau khi hoàn thành đơn (Chọn số sao + Viết bình luận).

---

## 📂 CẤU TRÚC THƯ MỤC DỰ ÁN (PHP + MYSQL)

```text
studio-management/               # Đặt trong C:/xampp/htdocs/studio-management/
├── config/                     # Cấu hình hệ thống
│   └── db.php                  # File kết nối MySQL PDO dùng chung
│
├── assets/                     # Tài nguyên tĩnh DÙNG CHUNG
│   ├── css/
│   │   └── common.css          # Style khung trang, font chữ, màu sắc chủ đạo chung
│   ├── js/
│   │   └── common.js           # Script dùng chung (Xử lý popup notification...)
│   └── uploads/                # Thư mục chứa hình ảnh sản phẩm do Vendor tải lên
│
├── includes/                   # Các thành phần giao diện khung chung (NGƯỜI A)
│   ├── header.php              # Thanh điều hướng Navbar
│   └── footer.php              # Chân trang Footer
│
├── PERSON_A/                   # === VÙNG CODE CỦA NGƯỜI A ===
│   ├── index.php               # Trang chủ
│   ├── search.php              # Trang tìm kiếm
│   ├── person_a.css            # File CSS riêng của Người A
│   ├── person_a.js             # File JS riêng của Người A
│   └── admin/                  # Thư mục trang quản trị Admin
│
├── PERSON_B/                   # === VÙNG CODE CỦA NGƯỜI B ===
│   ├── services.php            # Danh sách dịch vụ
│   ├── service-detail.php      # Chi tiết dịch vụ
│   ├── person_b.css            # File CSS riêng của Người B
│   ├── person_b.js             # File JS riêng của Người B
│   └── vendor/                 # Thư mục trang Vendor quản lý dịch vụ
│
├── PERSON_C/                   # === VÙNG CODE CỦA NGƯỜI C ===
│   ├── cart.php                # Trang giỏ hàng
│   ├── checkout.php            # Trang thanh toán
│   ├── vendor-orders.php       # Trang Vendor duyệt đơn
│   ├── person_c.css            # File CSS riêng của Người C
│   └── person_c.js             # File JS riêng của Người C
│
├── PERSON_D/                   # === VÙNG CODE CỦA NGƯỜI D ===
│   ├── login.php               # Đăng nhập
│   ├── register.php            # Đăng ký
│   ├── profile.php             # Hồ sơ cá nhân
│   ├── my-orders.php           # Đơn hàng cá nhân & Đánh giá
│   ├── person_d.css            # File CSS riêng của Người D
│   └── person_d.js             # File JS riêng của Người D
│
├── database/                   # Quản lý file Cơ sở dữ liệu MySQL
│   └── studio_db.sql           # File SQL export mới nhất từ phpMyAdmin
│
├── .gitignore                  # File bỏ qua file rác của Git
└── README.md
