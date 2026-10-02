<?php

session_start();

require_once '../config/db.php';

// Kiểm tra đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$message = '';
$message_type = '';


// Lấy thông tin người dùng
$sql = "SELECT id, name, email, role
        FROM users
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);


// Nếu không tìm thấy tài khoản
if (!$user) {
    session_unset();
    session_destroy();

    header('Location: login.php');
    exit;
}


// Xử lý khi cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';


    // Kiểm tra họ tên
    if ($name === '') {

        $message = 'Họ tên không được để trống.';
        $message_type = 'error';

    } elseif ($new_password !== '' && strlen($new_password) < 6) {

        $message = 'Mật khẩu mới phải có ít nhất 6 ký tự.';
        $message_type = 'error';

    } elseif ($new_password !== $confirm_password) {

        $message = 'Xác nhận mật khẩu không khớp.';
        $message_type = 'error';

    } else {

        // Cập nhật họ tên
        if ($new_password !== '') {

            // Có đổi mật khẩu
            $hashed_password = password_hash(
                $new_password,
                PASSWORD_DEFAULT
            );

            $sql = "UPDATE users
                    SET name = ?, password = ?
                    WHERE id = ?";

            $stmt = $conn->prepare($sql);

            $stmt->execute([
                $name,
                $hashed_password,
                $user_id
            ]);

        } else {

            // Chỉ đổi họ tên
            $sql = "UPDATE users
                    SET name = ?
                    WHERE id = ?";

            $stmt = $conn->prepare($sql);

            $stmt->execute([
                $name,
                $user_id
            ]);
        }


        // Cập nhật session
        $_SESSION['user_name'] = $name;

        $message = 'Cập nhật thông tin thành công.';
        $message_type = 'success';


        // Lấy lại thông tin mới nhất
        $sql = "SELECT id, name, email, role
                FROM users
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Hồ sơ cá nhân</title>

    <link rel="stylesheet" href="person_d.css">

</head>

<body>

    <div class="auth-container">

        <h1>Hồ sơ cá nhân</h1>


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
                value="<?= htmlspecialchars($user['name']) ?>"
                required
            >


            <label for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                value="<?= htmlspecialchars($user['email']) ?>"
                disabled
            >


            <label for="new_password">
                Mật khẩu mới
            </label>

            <input
                type="password"
                id="new_password"
                name="new_password"
                placeholder="Để trống nếu không muốn đổi"
            >


            <label for="confirm_password">
                Xác nhận mật khẩu mới
            </label>

            <input
                type="password"
                id="confirm_password"
                name="confirm_password"
                placeholder="Nhập lại mật khẩu mới"
            >


            <button type="submit">
                Lưu thay đổi
            </button>

        </form>


        <p>
            <a href="dashboard.php">
                Quay lại trang cá nhân
            </a>
        </p>

        <p>
            <a href="logout.php">
                Đăng xuất
            </a>
        </p>

    </div>

</body>

</html>