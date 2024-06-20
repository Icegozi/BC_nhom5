<?php
session_start();
require_once __DIR__ . '/../BLL/UserService.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userService = new UserService();
    $user = $userService->login($email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['type'];

        if ($user['type'] == 2) {
            header("Location: dashboard.php");
        } elseif ($user['type'] == 1) {
            header("Location: dashboard_admin.php");
        }
        exit();
    } else {
        echo '<script type="text/javascript">alert("Invalid email or password."); location.replace("login.php");</script>';
    }
}