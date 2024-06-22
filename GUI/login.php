<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <form action="config.php" method="post">
        <div class="container">
            <img src="https://file.vfo.vn/hinh/2018/03/top-nhung-hinh-anh-hinh-nen-real-madrid-dep-nhat-full-hd6.jpg"
                alt="hình ảnh">
            <div class="ui_login">
                <p class="heading">Log in</p>
                <input type="text" name="username" placeholder="Username" class="form-group" required>
                <input type="password" name="password" placeholder="Password" class="form-group" required>
                <input type="submit" value="Log in" class="btn" name="login">
            </div>
        </div>
    </form>
</body>

</html>