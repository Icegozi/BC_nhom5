<?php
require_once __DIR__ . '/../BLL/pitchManageService.php';
$result = getDataPitchforTable();
$result3 = getDataPitchforTable();
$showForm = isset($_POST['ButThem']);
$showForm2= isset($_POST['ButSua']);
$showForm3= isset($_POST['Anh']);
$showForm4 = isset($_POST['ButThongKe']);
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soccer field management</title>
    <link rel="stylesheet" href="./css/pitchManage.css?v = <?php echo time() ?>">
</head>

<body>
    <header class="header_pitchManage">
        <div class="header_content">
            <img class="logo" src="./img/logocauthu.png" alt="">
            <h1>Soccer field management</h1>
        </div>
        <nav class="menu2">
            <ul>
                <li>
                    <form method="post" action="">
                        <button name="ButThem" class="butthem">Add soccer field</button>
                    </form>
                </li>
                <li>
                    <form method="post" action=""><button name="ButSua" class="butsua">Update soccer field</button>
                    </form>
                </li>


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

                    <label for="pitchName">Pitch name:</label>
                    <input type="text" name="pitchName"><br><br>
                    <label for="pitchTimeStart">Start time:</label>
                    <input type="time" name="pitchTimeStart"><br><br>
                    <label for="pitchTimeEnd">End time:</label>
                    <input type="time" name="pitchTimeEnd"><br><br>
                    <label for="Description">Describe:</label>
                    <input type="text" name="Description"><br><br>
                    <label for="price_per_hour">Price per hour:</label>
                    <input type="text" name="price_per_hour"><br><br>
                    <label for="price_per_peak_hour">Price per peak hour:</label>
                    <input type="text" name="price_per_peak_hour"><br><br>
                    <label for="is_maintenance">Maintenance:</label>
                    <input type="text" name="is_maintenance"><br><br>
                    <label for="pitch_type_id">Pitch type id:</label>
                    <input type="text" name="pitch_type_id"><br><br>


                    <input name="ThemSanBong" type="submit" value="Add a soccer field">
                    <input name="ThoatThemSanBong" type="submit" value="Exit">

                </form>
            </div>
        </div>

        <?php endif;   ?>

        <?php
        if($_SERVER["REQUEST_METHOD"]=='POST')
         if ($showForm3): ?>

        <div class="modal3 show">
            <div class="modal-content3">
                <?php
        if (isset($_POST['hidenId'])) {
            $result2 = checkPic($_POST['hidenId']);
            if($result2){
                echo "<img src='$result2' alt=\"Mô Tả\">";
            }else{
                echo "Chưa có ảnh sân này trong dữ liệu";
            }
           
        } else {
            echo "No ID provided.";
        }
    
        ?>
            </div>
        </div>

        <?php endif; ?>

        <?php if ($showForm2): ?>
        <?php $IDs = getId(); ?>
        <div class="modal2">
            <div class="modal-content2">
                <form id="pitchForm2" action="pitchManage.php" method="post">
                    <label for="pitchId2">Pitch id:</label>
                    <select name="pitchId2">
                        <?php while($row = $result3->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <br><br>
                    <label for="pitchName2">Pitch name:</label>
                    <input type="text" name="pitchName2"><br><br>
                    <label for="pitchTimeStart2">Start time:</label>
                    <input type="time" name="pitchTimeStart2"><br><br>
                    <label for="pitchTimeEnd2">End time:</label>
                    <input type="time" name="pitchTimeEnd2"><br><br>
                    <label for="Description2">Describe:</label>
                    <input type="text" name="Description2"><br><br>
                    <label for="price_per_hour2">Price per hour:</label>
                    <input type="text" name="price_per_hour2"><br><br>
                    <label for="price_per_peak_hour2">Price per peak hour:</label>
                    <input type="text" name="price_per_peak_hour2"><br><br>
                    <label for="is_maintenance2">Maintenance:</label>
                    <input type="text" name="is_maintenance2"><br><br>
                    <label for="pitch_type_id2">Pitch type id:</label>
                    <input type="text" name="pitch_type_id2"><br><br>

                    <input name="SuaSanBong" type="submit" value="Updated soccer field">
                    <input name="ThoatSuaSanBong" type="submit" value="Exit">
                </form>
            </div>
        </div>

        <?php endif;   ?>




        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pitch name</th>
                    <th>Open time</th>
                    <th>Closing time</th>
                    <th>Describe</th>
                    <th>Price per hour</th>
                    <th>Price for 1 peak hour</th>
                    <th>Maintenance</th>
                    <th>Pitch type id</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Image</th>
                    <th>Delete</th>
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
                    echo "<td><form action='pitchManage.php' method='post'><button type='submit' name ='Anh' ><img class='iconeye' src='./img/iconeye.png' alt=''></button>
                    <input type='hidden' name='hidenId' value='". $row['id']."'></form></td>";
                    echo "<td> <form action='pitchManage.php' method='post'><button type='submit' name= 'Xoa' ><img class='icontrash' src='./img/Trash.jpg' alt=''></button>
                    <input type='hidden' name='hidenId' value='". $row['id']."'></form></td>";
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
        if(isset($_POST["ThoatThemSanBong"])) {
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
        if(isset($_POST["ThoatSuaSanBong"])) {
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