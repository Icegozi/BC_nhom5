<?php
include 'header_admin.php';
session_start();
require_once __DIR__ . '/../BLL/UserService.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userService = new UserService();
$user = $userService->getUserById($_GET['id']);

if (!$user) {
    echo "User not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    $name = $_POST['tenKhachHang'];
    $password = $_POST['matKhau'];
    $confirmPassword = $_POST['xacNhan'];
    $phone = $_POST['soDienThoai'];
    $email = $_POST['email'];
    $address = $_POST['diaChi'];

    if (!empty($password)) {
        if ($password !== $confirmPassword) {
            echo '<script>alert("Passwords do not match."); location.replace("editAdmin.php?action=edit&id=' . $userId . '");</script>';
            exit();
        }
        $hashedPassword = md5($password);
    } else {
        $hashedPassword = $user['password'];
    }

    if($userService->isEmailExist($email)){
        echo '<script type="text/javascript">alert("Email already exists in the system."); location.replace("editAdmin.php?action=edit&id=' . $userId . '");</script>';
        exit();
    }
    
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        echo '<script>alert("Phone number must be 10 digits."); location.replace("editAdmin.php?action=edit&id=' . $userId . '");</script>';
        exit();
    }

    $updated = $userService->updateUser($userId, $name, $hashedPassword, $phone, $email, $address);

    if ($updated) {
        echo '<script>alert("Profile updated successfully."); location.replace("dashboard_admin.php");</script>';
        exit();
    } else {
        echo '<script>alert("Failed to update profile."); location.replace("editAdmin.php?action=edit&id=' . $userId . '");</script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit admin</title>
    <link rel="stylesheet" href="css/userEdit.css?v=<?php echo time(); ?>">
</head>

<body>
    <h2>EDIT ADMIN</h2>
    <div class="container">
        <div class="col-md-6">
            <form action="" method="post">
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                <div class="form-group">
                    <label for="tenKhachHang">User name</label><br>
                    <input type="text" class="form-control" id="tenKhachHang" name="tenKhachHang"
                        value="<?php echo $user['name']; ?>">
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="matKhau">Password</label><br>
                        <input type="password" class="form-control" id="matKhau" name="matKhau" value="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="xacNhan">Confirm password</label><br>
                        <input type="password" class="form-control" id="xacNhan" name="xacNhan" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="soDienThoai">Phone number</label><br>
                    <input type="text" class="form-control" id="soDienThoai" name="soDienThoai"
                        value="<?php echo $user['phone']; ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email</label><br>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo $user['email']; ?>">
                </div>

                <div class="form-group">
                    <label for="diaChi">Address</label><br>
                    <input type="text" class="form-control" id="diaChi" name="diaChi"
                        value="<?php echo $user['address']; ?>">
                </div>

                <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php 
    include 'footer.php';
?>