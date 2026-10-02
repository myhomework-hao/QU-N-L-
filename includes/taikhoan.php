<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$goc = '/studio-management';
$vaiTro = $_SESSION['role'] ?? 'guest';
$tenHienThi = $_SESSION['name'] ?? '';

$danhSachMenu = [
    'guest' => [
        ['Đăng nhập', '/PERSON_D/login.php'],
        ['Đăng ký', '/PERSON_D/register.php'],
    ],
    'customer' => [
        ['Hồ sơ cá nhân', '/PERSON_D/profile.php'],
        ['Đơn của tôi', '/PERSON_D/my-orders.php'],
        ['Đăng xuất', '/PERSON_D/logout.php'],
    ],
    'vendor' => [
        ['Hồ sơ cá nhân', '/PERSON_D/profile.php'],
        ['Dịch vụ của tôi', '/PERSON_B/vendor/my-services.php'],
        ['Đơn nhận', '/PERSON_C/vendor-orders.php'],
        ['Đăng xuất', '/PERSON_D/logout.php'],
    ],
    'admin' => [
        ['Quản trị', '/PERSON_A/admin/dashboard.php'],
        ['Hồ sơ cá nhân', '/PERSON_D/profile.php'],
        ['Đăng xuất', '/PERSON_D/logout.php'],
    ],
];

$menuHienTai = $danhSachMenu[$vaiTro] ?? $danhSachMenu['guest'];
?>
<details class="tai-khoan">
    <summary aria-label="Tài khoản">
        <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="8" r="4"></circle>
            <path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"></path>
        </svg>
    </summary>
    <div class="tai-khoan-menu">
        <?php if ($tenHienThi): ?>
            <div class="tai-khoan-ten"><?= htmlspecialchars($tenHienThi) ?></div>
        <?php endif; ?>
        <?php foreach ($menuHienTai as [$nhan, $duongDan]): ?>
            <a href="<?= $goc . $duongDan ?>"><?= $nhan ?></a>
        <?php endforeach; ?>
    </div>
</details>

<script>
document.addEventListener('click', function (e) {
    document.querySelectorAll('details.tai-khoan[open]').forEach(function (o) {
        if (!o.contains(e.target)) o.removeAttribute('open');
    });
});
</script>