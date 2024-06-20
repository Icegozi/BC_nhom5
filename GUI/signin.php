<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/signin.css">
</head>

<body>
    <form action="config.php" method="post">
        <div class="constraner">
            <div class="form-title">
                <p>Register</p>
            </div>
            <div class="form-controler">
                <label for="firstname">Firstname</label><br>
                <input type="text" name="firstname" id="firstname" placeholder="e.g: A" required>
            </div>
            <div class="form-controler">
                <label for="lastname">Lastname</label><br>
                <input type="text" name="lastname" id="lastname" placeholder="e.g: Nguyễn Văn" required>
            </div>
            <div class="form-controler">
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" placeholder="e.g: abc@123" required>
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
                <input type="text" name="address" id="address" placeholder="e.g: Quảng Ninh, Hà Nội,..." required>
            </div>
            <div class="form-controler">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" placeholder="e.g: NguyenVanA@gmail.com" required>
            </div>
            <div class="btn">
                <input type="submit" value="Sign in" name="register">
            </div>
        </div>
    </form>
</body>

</html>