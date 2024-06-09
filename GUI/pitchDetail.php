<?php
    // $_SESSION['name'];
    $name = 'Sân Vận Động HAUI';
    $avt_pitches = array('./images/templatemo-wave-footer.jpg');

    $date_now = date('Y-m-d');
    $status = 'Đang hoạt động';
    $volume = 7;
    $price_perhour = 400000;
    $price_perpeak = 800000;
    $time_open = '07 giờ sáng';
    $time_close = '22 giờ chiều';
    $times = 4;
    $note = 'Sân này xịn lắm, đặt là có ny ngày^^';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin - <?php echo $name;?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { display: flex; }
        .left-panel { width: 50%; }
        .right-panel { width: 50%; }
        .field-info { margin-bottom: 20px; }
        .field-info label { font-weight: bold; }
        .field-info span { margin-left: 10px; }
        .button { background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; }
        .image-button { border-radius: 50%; width: 10px; height: 10px; margin: 10px; }
        .description { margin-top: 20px;}
        .overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.7); display: none; }
        .popup { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 20px; background: #f0f0f0; padding: 20px; width: 700px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); }
        .close-btn { position: absolute; top: 10px; right: 10px; cursor: pointer; }
        .field-image img { width: 80%; height: auto; margin-right: 20px; position: relative; }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        tr {
            width: 80%;
            padding-right: 20px;
            padding-left: 20px;
        }
        td:first-child {
            width: 60%;
        }
        button, input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: black;
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='left-panel'>
            <div class="field-image">
                <img src=<?php echo $avt_pitches[0];?> alt="Sân bóng">
            </div>
           <div class="settings">
                <?php
                    $length = count($avt_pitches);
                    for ($i=0; $i<$length; $i++) {
                        echo '<button class="image-button" onclick="changeImage(' . $avt_pitches[$i] . ')"></button>';
                    }
                ?>
           </div>
        </div>
        <div class='right-panel'>
            <h1>Thông tin</h1>
            <div class="field-info">
                <label>Tên sân: </label>
                <span><?php echo $name;?></span>
            </div>
            <div class="field-info">
                <label>Tình trạng: </label>
                <span><?php echo $status;?></span>
            </div>
            <div class="field-info">
                <label>Số người: </label>
                <span><?php echo $volume;?> người</span>
            </div>
            <div class="field-info">
                <label>Giá tiền: </label>
                <span><?php echo $price_perhour . 'đ - ' . $price_perpeak . 'đ';?></span>
            </div>
            <div class="field-info">
                <label>Thời gian mở - đóng: </label>
                <span><?php echo $time_open . ' - ' . $time_close;?></span>
            </div>
            <div class="field-info">
                <label>Số lần đặt: </label>
                <span><?php echo $times;?></span>
            </div>
            <div class="field-info">
                <label>Sân liên kết</label>
            </div>
            <button class="button" onclick="openPopup()">Đặt ngay</button>
            <button class="button">Xem thời gian sân đã đặt</button>
            <div class="field-info description">
                <label>Mô tả</label>
                <span><?php echo $note;?></span>
            </div>
            <div id="popup-overlay" class="overlay">
                <div class="popup">
                    <h1>Đặt sân</h1>
                    <p style="margin-bottom: 20px;">Đặt sân bóng đá tại đây!</p>
                    <form action="" method="post">
                    <table>
                        
                            <tr>
                                <td><label for="date">Chọn ngày</label></td>
                                <td><input type="date" name="date" value=<?php echo $date_now?>></td>
                            </tr>
                            <tr>
                                <td><label for="start_time">Chọn giờ bắt đầu</label></td>
                                <td><input type="time" name="start_time" value="07:00"></td>
                            </tr>
                            <tr>
                                <td><label for="end_time">Chọn giờ kết thúc</label></td>
                                <td><input type="time" name="end_time" value="07:00"></td>
                            </tr>
                            <tr style="margin-top: 30px;">
                                <td><label for="name">Họ và tên (*)</label></td>
                                <td><input type="text" name="name" required></td>
                            </tr>
                            <tr>
                                <td><label for="phone">Số điện thoại (*)</label></td>
                                <td><input type="tel" name="phone" required></td>
                            </tr>
                            <tr>
                                <td><label for="email">Email</label></td>
                                <td><input type="email" name="email"></td>
                            </tr>
                    </table>
                    <div>
                        <input type="submit" value="Đặt sân">
                        <button type="button" class="close-btn" onclick="closePopup()">Đóng</button>
                    </div>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeImage(imageSrc) {
            document.getElementById('field-image').src = imageSrc;
        }
        function openPopup() {
            document.getElementById('popup-overlay').style.display = 'block';
        }
        function closePopup() {
            document.getElementById('popup-overlay').style.display = 'none';
        }
    </script>
</body>
</html>