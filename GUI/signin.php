<?php
session_start();
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
unset($_SESSION['error']);
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/signin.css?v=<?php echo time(); ?>">
</head>

<body>
    <form action="registerHandler.php" method="post">
        <div class="container">
            <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
            <div class="form-title">
                <p>Register</p>
            </div>
            <div class="form-controler">
                <label for="firstname">Firstname</label><br>
                <input type="text" name="firstname" id="firstname" placeholder="e.g: A"
                    value="<?php echo htmlspecialchars($form_data['firstname'] ?? ''); ?>" required>
            </div>
            <div class="form-controler">
                <label for="lastname">Lastname</label><br>
                <input type="text" name="lastname" id="lastname" placeholder="e.g: Nguyễn Văn"
                    value="<?php echo htmlspecialchars($form_data['lastname'] ?? ''); ?>" required>
            </div>
            <div class="form-controler">
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-controler">
                <label for="confirmPass">Confirm Password</label><br>
                <input type="password" name="confirmPass" id="confirmPass" required>
            </div>
            <div class="form-controler">
                <label for="address">Address</label><br>
                <input type="text" name="address" id="address" placeholder="e.g: Quảng Ninh, Hà Nội,..."
                    value="<?php echo htmlspecialchars($form_data['address'] ?? ''); ?>" required>
            </div>
            <div class="form-controler">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" placeholder="e.g: NguyenVanA@gmail.com"
                    value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>" required>
            </div>
            <div class="btn">
                <input type="submit" value="Register" name="register">
            </div>
        </div>
    </form>
</body>

</html>