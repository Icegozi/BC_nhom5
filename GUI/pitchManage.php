<?php
require_once __DIR__ . '/../BLL/pitchManageService.php';
$result = getDataPitchforTable();
$showForm = isset($_POST['ButThem']);
$showForm2= isset($_POST['ButSua']);

ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sân bóng</title>
    <link rel="stylesheet" href="./css/pitchManage.css">
</head>

<body>
    <header class="header_pitchManage">
        <div class="header_content">
            <img class="logo" src="./img/logocauthu.png" alt="">
            <h1>Quản Lý Sân Bóng</h1>
        </div>
        <nav class="menu2">
            <ul>
                <li>
                    <form method="post" action="">
                        <button name="ButThem" class="butthem">Thêm sân bóng</button>
                    </form>
                </li>
                <li>
                    <form method="post" action=""><button name="ButSua" class="butsua">Sửa sân bóng</button></form>
                </li>
                <li><a href="#">Thống kê và báo cáo</a></li>
                <li><a href="#">Hỗ trợ khách hàng</a></li>
                <li><input type="text" readonly value=" Admin Manage Page"></li>
                <li><a href="#"><img id="Adminpic" src="./img/Admin.jpg" alt=""></a></li>
            </ul>
        </nav>
    </header>

    <body class="body_pitchManage">

        <?php if ($showForm): ?>
        <div class="modal">
            <div class="modal-content">
                <form id="pitchForm" action="pitchManage.php" method="post">

                    <label for="pitchName">Tên Sân:</label>
                    <input type="text" name="pitchName" required><br><br>
                    <label for="pitchTimeStart">Thời gian mở:</label>
                    <input type="time" name="pitchTimeStart" required><br><br>
                    <label for="pitchTimeEnd">Thời gian đóng:</label>
                    <input type="time" name="pitchTimeEnd" required><br><br>
                    <label for="Description">Mô tả:</label>
                    <input type="text" name="Description" required><br><br>
                    <label for="price_per_hour">Giá 1 giờ:</label>
                    <input type="text" name="price_per_hour" required><br><br>
                    <label for="price_per_peak_hour">Giá 1 giờ cao điểm:</label>
                    <input type="text" name="price_per_peak_hour" required><br><br>
                    <label for="is_maintenance">Số lần bảo trì:</label>
                    <input type="text" name="is_maintenance" required><br><br>
                    <label for="pitch_type_id">Mã kiểu sân:</label>
                    <input type="text" name="pitch_type_id" required><br><br>


                    <input name="ThemSanBong" type="submit" value="Thêm Sân Bóng">

                </form>
            </div>
        </div>

        <?php endif;   ?>


        <?php if ($showForm2): ?>
        <div class="modal2">
            <div class="modal-content2">
                <form id="pitchForm2" action="pitchManage.php" method="post">
                    <label for="pitchId2">Mã Sân:</label>
                    <input type="text" name="pitchId2" required><br><br>
                    <label for="pitchName2">Tên Sân:</label>
                    <input type="text" name="pitchName2" required><br><br>
                    <label for="pitchTimeStart2">Thời gian mở:</label>
                    <input type="time" name="pitchTimeStart2" required><br><br>
                    <label for="pitchTimeEnd2">Thời gian đóng:</label>
                    <input type="time" name="pitchTimeEnd2" required><br><br>
                    <label for="Description2">Mô tả:</label>
                    <input type="text" name="Description2" required><br><br>
                    <label for="price_per_hour2">Giá 1 giờ:</label>
                    <input type="text" name="price_per_hour2" required><br><br>
                    <label for="price_per_peak_hour2">Giá 1 giờ cao điểm:</label>
                    <input type="text" name="price_per_peak_hour2" required><br><br>
                    <label for="is_maintenance2">Số lần bảo trì:</label>
                    <input type="text" name="is_maintenance2" required><br><br>
                    <label for="pitch_type_id2">Mã kiểu sân:</label>
                    <input type="text" name="pitch_type_id2" required><br><br>

                    <input name="SuaSanBong" type="submit" value="Sửa Thông Tin Sân Bóng">
                </form>
            </div>
        </div>

        <?php endif;   ?>

        <?php
        
    ?>


        <table>
            <thead>
                <tr>
                    <th>Mã Sân</th>
                    <th>Tên Sân</th>
                    <th>Thời gian mở</th>
                    <th>Thời gian đóng</th>
                    <th>Mô tả</th>
                    <th>Giá 1 giờ</th>
                    <th>Giá 1 giờ cao điểm</th>
                    <th>Số lần bảo trì</th>
                    <th>Mã kiểu sân</th>
                    <th>Được tạo vào</th>
                    <th>Được cập nhật vào</th>
                    <th>Hình ảnh sân</th>
                    <th>Xóa sân</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["time_start"] . "</td>";
                    echo "<td>" . $row["time_end"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["price_per_hour"] . "</td>";
                    echo "<td>" . $row["price_per_peak_hour"] . "</td>";
                    echo "<td>" . $row["is_maintenance"] . "</td>";
                    echo "<td>" . $row["pitch_type_id"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td>" . $row["updated_at"] . "</td>";
                    echo "<td><button type='submit'  ><img class='iconeye' src='./img/iconeye.png' alt=''></button></td>";
                    echo "<td> <form action='pitchManage.php' method='post'><button type='submit' name= 'Xoa' ><img class='icontrash' src='./img/Trash.jpg' alt=''></button>
                    <input type='hidden' name='hidenId' value='" . $row['id'] . "'></form></td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
        <?php
        if($_SERVER["REQUEST_METHOD"]==='POST') {
            if (isset($_POST['ThemSanBong'])) {
            
           $created_at= date('Y-m-d H:i:s'); 
           $updated_at= null;
            checkAddingPitch($_POST['pitchName'], $_POST['pitchTimeStart'], $_POST['pitchTimeEnd'], $_POST['Description'], $_POST['price_per_hour'], 
            $_POST['price_per_peak_hour'], $_POST['is_maintenance'], $_POST['pitch_type_id'], $created_at, $updated_at);
            header("Location: dashboard_admin.php?pg=pitchManage");
              exit();
        }
        
         if(isset($_POST['SuaSanBong'])){
            
            $updated_at= date('Y-m-d H:i:s'); 
            checkUpdatePitch($_POST['pitchId2'] ,$_POST['pitchName2'], $_POST['pitchTimeStart2'], $_POST['pitchTimeEnd2'], $_POST['Description2'], $_POST['price_per_hour2'], 
            $_POST['price_per_peak_hour2'], $_POST['is_maintenance2'], $_POST['pitch_type_id2'], $updated_at);
            header("Location: dashboard_admin.php?pg=pitchManage");
              exit();
        }
        if(isset($_POST['Xoa'])){
                $delid = $_POST['hidenId'];
                checkDelete($delid);
                header("Location: dashboard_admin.php?pg=pitchManage");
                exit();
        }
       }
    ?>
    </body>
    <footer></footer>

</html>