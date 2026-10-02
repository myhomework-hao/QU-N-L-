<?php

require_once '../config/db.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Kiểm tra dữ liệu
    if ($name === '' || $email === '' || $password === '' || $confirm_password === '') {

        $message = 'Vui lòng nhập đầy đủ thông tin.';
        $message_type = 'error';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = 'Email không hợp lệ.';
        $message_type = 'error';

    } elseif (strlen($password) < 6) {

        $message = 'Mật khẩu phải có ít nhất 6 ký tự.';
        $message_type = 'error';

    } elseif ($password !== $confirm_password) {

        $message = 'Mật khẩu xác nhận không khớp.';
        $message_type = 'error';

    } else {

        // Kiểm tra email đã tồn tại chưa
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->fetch()) {

            $message = 'Email này đã được sử dụng.';
            $message_type = 'error';

        } else {

            // Mã hóa mật khẩu
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // 0 = Customer
            $role = 0;

            // Thêm tài khoản vào database
            $sql = "INSERT INTO users (name, email, password, role)
                    VALUES (?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->execute([
                $name,
                $email,
                $hashed_password,
                $role
            ]);

            $message = 'Đăng ký thành công!';
            $message_type = 'success';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng ký - Studio Management</title>

    <link rel="stylesheet" href="person_d.css">
</head>

<body>

    <div class="auth-container">

        <h1>Đăng ký tài khoản</h1>

        <?php if ($message !== ''): ?>

            <p class="message <?= htmlspecialchars($message_type) ?>">
                <?= htmlspecialchars($message) ?>
            </p>

        <?php endif; ?>


        <form method="POST" action="">

            <label for="name">
                Họ và tên
            </label>

            <input
                type="text"
                id="name"
                name="name"
                placeholder="Nhập họ và tên"
                value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                required
            >


            <label for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Nhập email"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                required
            >


            <label for="password">
                Mật khẩu
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Nhập mật khẩu"
                required
            >


            <label for="confirm_password">
                Xác nhận mật khẩu
            </label>

            <input
                type="password"
                id="confirm_password"
                name="confirm_password"
                placeholder="Nhập lại mật khẩu"
                required
            >


            <button type="submit">
                Đăng ký
            </button>

        </form>


        <p>
            Đã có tài khoản?
            <a href="login.php">Đăng nhập</a>
        </p>

    </div>

</body>

</html>