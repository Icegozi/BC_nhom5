<?php
require_once __DIR__ . '/../BLL/UserService.php';

$userService = new UserService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    // Thực hiện thêm user
    $result = $userService->addUser($name, $email, $phone, $address, $type);
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
    <link rel="stylesheet" href="css/addUser.css?v= <?php echo time() ?>">
</head>

<body>
    <div class="container">
        <h2>Add New User</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
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
</body>

</html>