<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sửa thông tin cá nhân</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Sono:wght@200;300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link href="css/templatemo-pod-talk.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.2/collection/components/icon/icon.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.2/ionicons.js"></script>

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            padding: 5px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 20px;
        }

        .form-control[readonly] {
            background-color: #e9ecef;
            opacity: 1;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .img-fluid {
            max-width: 65%;
            height: 50%;
            border-radius: 50%;
            margin-left: 20%;
        }

        .title {
            margin-left: 28%;
        }

        #content {
            width: 100%;
            height: 31%;
            background-color: none;
            border: none;
            text-align: center;
            color: black;
            font-family: "Shadows Into Light", cursive;
            font-weight: 500;
            font-style: normal;
            font-size: 24px;
        }

        .col-md-6 label {
            font-weight: bold;
            font-size: larger;
        }

        .password-wrapper{
            display: flex;
            flex-wrap: wrap;
        }
        .password-wrapper ion-icon {
            margin-top: 32px;
            margin-left: 15px;
            font-size: 30px;
            color: #6c757d;
            cursor: pointer;
        }
        .password-wrapper .form-control{
            padding-right: 150px;
        }
    </style>

</head>

<body>

    <main>
        <header class="site-header d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="col-lg-12 col-12 text-center">
                    <h2 class="mb-0">Edit Profile</h2>
                </div>
            </div>
        </header>

        <section class="edit-profile" id="">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="images/medium-shot-young-people-recording-podcast.jpg" alt="Hình ảnh" class="img-fluid"><br>
                        <h4 class="title">Hà Xuân Phúc</h4>
                        <textarea name="content" id="content" readonly>Hiện tại là quá khứ của tương lai, hôm nay là bức hình của khoảnh khắc</textarea>
                    </div>
                    <div class="col-md-6">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="tenKhachHang">Full name</label>
                                <input type="text" class="form-control" id="tenKhachHang" name="tenKhachHang" value="Hà Xuân Phúc">
                            </div>
                            <div class="form-group">
                                <label for="tenTaiKhoan">User name</label>
                                <input type="text" class="form-control" id="tenTaiKhoan" name="tenTaiKhoan" value="Icegozi">
                            </div>
                             <div class="form-group password-wrapper">
                                <div class="">
                                    <label for="matKhau">Password:</label>
                                    <input disabled type="password" class="form-control" id="matKhau" name="matKhau" value="123456789">
                                </div>
                                <a href="#"><ion-icon name="hammer-outline"></ion-icon></a>
                            </div>
                            <div class="form-group">
                                <label for="soDienThoai">Phone number</label>
                                <input type="text" class="form-control" id="soDienThoai" name="soDienThoai" value="0964203698">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="sinhvien2k3@gmail.com">
                            </div>
                            <div class="form-group">
                                <label for="diaChi">Address</label>
                                <input type="text" class="form-control" id="diaChi" name="diaChi" value="Ngõ 1, đường Hoàng Hoa thám, Hà Nội">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
