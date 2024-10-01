<?php
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; // Initialize user variable
$id = NULL;

if (!empty($_GET['id'])) {
    $id = base64_decode($_GET['id']); // Decode the ID if it was encoded
    $user = $userModel->findUserById($id); // Fetch user details
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
<?php include 'views/header.php' ?>
<div class="container">
    <?php if ($user) { ?>
        <div class="alert alert-warning" role="alert">
            User Profile
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <span><?php echo htmlspecialchars($user['name']); ?></span>
        </div>
        <div class="form-group">
            <label for="fullname">Fullname:</label>
            <span><?php echo htmlspecialchars($user['fullname']); ?></span>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <span><?php echo htmlspecialchars($user['email']); ?></span>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            User not found!
        </div>
    <?php } ?>
</div>
</body>
</html>
