    <?php
    session_start();
    require_once 'models/UserModel.php';
    $userModel = new UserModel();

    $user = NULL;
    $_id = NULL;

    if (isset($_GET['id'])) {
        $decodedId = base64_decode($_GET['id']);
        if (is_numeric($decodedId)) {
            $_id = intval($decodedId); 
            $user = $userModel->findUserById($_id); 
        }
    }

    // Kiểm tra xem có form submit hay không
   if (!empty($_POST['submit'])) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    if (empty($name)) {
        $errors['name'] = "Tên không được để trống";
    } elseif (!preg_match('/^[A-Za-z0-9]{5,15}$/', $name)) {
        $errors['name'] = "Tên phải dài từ 5 đến 15 ký tự và chỉ chứa chữ cái và số.";
    }


    if (empty($password)) {
        $errors['password'] = "Mật khẩu không được để trống";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~!@#$%^&*()])[A-Za-z0-9~!@#$%^&*()]{5,10}$/', $password)) {
        $errors['password'] = "Mật khẩu phải dài từ 5 đến 10 ký tự và Phải bao gồm: chữ thường (a->z), chữ HOA (A->Z), số (0-9) và ký tự đặc biệt: ~!@#$%^&*()";
    }

    if (empty($errors)) {
        if (!empty($_id)) {
            $userModel->updateUser($_POST);
        } else {
            $userModel->insertUser($_POST);
        }
        header('Location: list_users.php');
        exit();
    }
}
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>User form</title>
        <?php include 'views/meta.php' ?>
    </head>
    <body>
        <?php include 'views/header.php'?>
        <div class="container">
            <?php if ($user || !isset($_id)) { ?>
                <div class="alert alert-warning" role="alert">
                    User form
                </div>
                <form method="POST">
                <input type="hidden" name="id" value="<?php echo $_id ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" placeholder="Name" value='<?php if (!empty($user['name'])) echo $user['name']; ?>'>
                    <?php if (!empty($errors['name'])): ?>
                        <div class="alert alert-danger"><?php echo $errors['name']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <?php if (!empty($errors['password'])): ?>
                        <div class="alert alert-danger"><?php echo $errors['password']; ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    User not found!
                </div>
            <?php } ?>
        </div>
    </body>
    </html>
