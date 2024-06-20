<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sửa thông tin cá nhân</title>



    <link rel="stylesheet" href="css/userEdit.css">


</head>

<body>
    <h1>Edit profile</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="tenKhachHang">Full name</label><br>
                        <input type="text" class="form-control" id="tenKhachHang" name="tenKhachHang"
                            value="Hà Xuân Phúc">
                    </div>
                    <div class="form-group">
                        <label for="tenTaiKhoan">User name</label><br>
                        <input type="text" class="form-control" id="tenTaiKhoan" name="tenTaiKhoan" value="Icegozi">
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label for="matKhau">Password:</label><br>
                            <input disabled type="password" class="form-control" id="matKhau" name="matKhau"
                                value="123456789">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="soDienThoai">Phone number</label><br>
                        <input type="text" class="form-control" id="soDienThoai" name="soDienThoai" value="0964203698">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" class="form-control" id="email" name="email" value="sinhvien2k3@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="diaChi">Address</label><br>
                        <input type="text" class="form-control" id="diaChi" name="diaChi"
                            value="Ngõ 1, đường Hoàng Hoa thám, Hà Nội">
                    </div>
                    <button type="submit" class="btn">Update</button>
                </form>
            </div>
        </div>
    </div>
    </main>
</body>

</html>