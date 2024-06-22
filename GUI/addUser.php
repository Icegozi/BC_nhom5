<?php
require_once __DIR__ . '/../BLL/UserService.php';
include 'header_admin.php';
$userService = new UserService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $type = trim($_POST['type']);
    $password = trim($_POST['password']);

    // Check if the password length is at least 8 characters before hashing
    if (strlen($password) < 8) {
        echo '<script type="text/javascript">alert("Password must have at least 8 characters."); location.replace("addUser.php");</script>';
        exit();
    }

    // Hash the password after validation
    $hashedPassword = md5($password);

    // Check if the email already exists
    if($userService->isEmailExist($email)){
        echo '<script type="text/javascript">alert("Email already exists in the system."); location.replace("addUser.php");</script>';
        exit();
    }

    if (!preg_match('/^[0-9]{10}$/', $phone)) {
         echo '<script type="text/javascript">alert("Phone number must be 10 digits."); location.replace("addUser.php");</script>';
        exit();
    }
    
    $result = $userService->addUser($name, $email, $hashedPassword, $phone, $address, $type);
    if ($result) {
        echo '<script type="text/javascript">alert("User added successfully."); location.replace("dashboard_admin.php");</script>';
        exit();
    } else {
        echo "Failed to add user.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="css/addUser.css?v=<?php echo time(); ?>">
</head>

<body>
    <h2>Add New User</h2>
    <div class="container">
        <div class="col-md-6">
            <form method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select id="type" name="type" class="form-control" required>
                        <option value="1">Admin</option>
                        <option value="2">Customer</option>
                    </select>
                </div>
                <button type="submit" class="btn">Add User</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php
include 'footer.php';
?>