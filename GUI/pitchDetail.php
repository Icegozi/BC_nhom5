<?php
    // $_SESSION['name'];
    $name = '';
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
    <title>Thông tin - <?php echo '$name';?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { display: flex; }
        .left-panel { width: 50%; }
        .right-panel { width: 50%; }
        .field-info { margin-bottom: 20px; }
        .field-info label { font-weight: bold; }
        .field-info span { margin-left: 10px; }
        .button { background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; }
        .image-button { border-radius: 50%; width: 50px; height: 50px; margin: 10px; }
        .description { margin-top: 20px;}
    </style>
</head>
<body>
    <div class='container'>
        <div class='left-panel'>
           <img src=<?php echo $avt_pitches[0];?> alt="Sân bóng">
           <div class="settings">
                <?php
                    $length = count($avt_pitches);
                    for ($i=0; $i<$length; $i++) {
                        echo '<button class="image-button" onclick="changeImage(' . $avt_pitches[$i] . ')">1</button>';
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
            <button class="button">Đặt ngay</button>
            <button class="button">Xem thời gian sân đã đặt</button>
            <div class="field-info description">
                <label>Mô tả</label>
                <span><?php echo $note;?></span>
            </div>
        </div>
    </div>
    <script>
        function changeImage(imageSrc) {
            document.getElementById('field-image').src = imageSrc;
        }
    </script>
</body>
</html>