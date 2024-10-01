<?php
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$id = NULL;
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel->deleteUserById($id);
    header('Location: list_users.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận xóa người dùng</title>
    <?php include 'views/meta.php'; ?>
</head>
<body>
    <?php include 'views/header.php'; ?>
    <div class="container">
        <h2>Xác nhận xóa người dùng</h2>
        <p>Bạn có chắc chắn muốn xóa người dùng với ID: <?php echo htmlspecialchars($id); ?>?</p>
        <form method="POST">
            <button type="submit" class="btn btn-danger">Xóa</button>
            <a href="list_users.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
