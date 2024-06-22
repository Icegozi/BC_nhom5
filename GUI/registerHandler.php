<?php
session_start();
require_once __DIR__ . '/../BLL/UserService.php';
$userService = new UserService();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $password = trim($_POST['password']);
    $confirmPass = trim($_POST['confirmPass']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $type = 2;

    $_SESSION['form_data'] = $_POST; 

    if (strlen($password) < 8) {
        $_SESSION['error'] = "Password must have at least 8 characters.";
        header('Location: signin.php');
        exit;
    }

    if ($password !== $confirmPass) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: signin.php');
        exit;
    }

    if ($userService->isEmailExist($email)) {
        $_SESSION['error'] = "Email already exists in the system.";
        header('Location: signin.php');
        exit;
    }

    $hashedPassword = md5($password);

    $result = $userService->addUser($lastname . ' ' . $firstname, $email, $hashedPassword, "", $address, $type);

    if ($result) {
        $_SESSION['success'] = "User registered successfully.";
        unset($_SESSION['form_data']);
        header('Location: login.php');
    } else {
        $_SESSION['error'] = "Failed to register user.";
        header('Location: signin.php');
    }
} else {
    $_SESSION['error'] = "Invalid request.";
    header('Location: signin.php');
}