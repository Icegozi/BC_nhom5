<?php
    require_once '../BLL/pitchService.php';
    require_once '../BLL/orderService.php';
    //$pitch_id = $_SESSION['id'];
    //$user_id = $_SESSION['user_id'];
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['football_id']))
        $pitch_id = $_GET['football_id'];
        else $pitch_id = 1;
    }
    else $pitch_id = 1;
    $user_id = 1;
    $pitch_details = getPitch($pitch_id);
    if ($pitch_details != null) {
        $name = $pitch_details['name'];
        $time_open = $pitch_details['time_start'];
        $time_close = $pitch_details['time_end'];
        $date_now = date('Y-m-d');
        $avt_pitches = getPichesDetails($pitch_id);
        if ($pitch_details['is_maintenance'] == 0) {
            $status = 'Đang hoạt động';
        }
        else {
            $status = 'Đang bảo trì';
        }
        $volume = $pitch_details['quantity'];
        $price_perhour = $pitch_details['price_per_hour'];
        $price_perpeak = $pitch_details['price_per_peak_hour'];
        $times = getTimeOrder($user_id, $pitch_id);
        $note = $pitch_details['description'];
        $type_note = $pitch_details['type_note'];
    }
    else {
        echo 'Not found Sân này.';
        die("");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin - <?php echo $name;?></title>
    <style>
        body { font-family: Arial, sans-serif; padding: 0 10vh 0px 10vh;}
        .container { display: flex; }
        .left-panel { display: flex; flex-direction: column; align-items: center; justify-content: center; width: 60%; padding-right: 150px; }
        .right-panel { width: 40%; padding-left: 40px; }
        .field-info { margin-bottom: 20px; }
        .field-info label { font-weight: bold; }
        .field-info span { margin-left: 10px; }
        .button { background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; }
        .image-button { border-radius: 50%; width: 10px; height: 10px; margin: 10px; }
        .description { margin-top: 20px;}
        .overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.7); display: none; }
        .popup { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 20px; background: #f0f0f0; padding: 20px; width: 700px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); }
        .close-btn { position: absolute; top: 10px; right: 10px; cursor: pointer; }
        .field-image { display: flex; justify-content: center; align-items: center; border-radius: 20px; }
        .field-image img { width: 100%; height: auto; max-width: 100%; max-height: 400px; border-radius: 20px; object-fit: cover; }
        .field-image { position: relative; width: 100%; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .field-image img { width: 100%; height: 100%;  transition: opacity 1s ease-in-out; opacity: 1; }
        .field-image img.hidden { opacity: 0; }
        .thumbnails-container {
            display: flex;
            justify-content: center;;
            margin-top: 20px;
            width: 100%; /* Đặt chiều rộng tối đa của phần chứa hình ảnh thu nhỏ */
            overflow: hidden;
        }

        .thumbnails {
            display: flex;
            gap: 10px;
            flex-wrap: nowrap;
            justify-content: flex-start; /* Căn trái các hình thu nhỏ */
            transition: transform 0.1s ease-in-out; /* Hiệu ứng chuyển đổi mượt mà khi cuộn */
        }

        .thumbnails img {
            width: 150px;
            height: 100px;
            cursor: pointer;
            transition: transform 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .thumbnails img:hover {
            transform: scale(1.1);
        }

        .scroll-buttons {
            display: none; /* Mặc định ẩn các nút cuộn */
            justify-content: space-between;
            width: 800px; /* Phải khớp với chiều rộng của phần chứa hình ảnh thu nhỏ */
            margin-top: 10px;
        }

        .scroll-buttons button {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .scroll-buttons button:hover {
            background-color: #eee;
        }
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            opacity: 1;
            transition: transform 0.2s ease-out, box-shadow 0.2s ease-out, opacity 0.2 ease-out;
        }
        button:active, input[type="submit"]:active {
            transform: scale(1.1); /* Phóng to lên 110% khi nhấn */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
            opacity: 1;
        }
        button:hover, input[type="submit"]:hover {
            transform: scale(1.1); /* Phóng to lên 110% khi nhấn */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Đổ bóng nhẹ */
            opacity: 0.9;
        }
        
        
    </style>
</head>
<body>
    <div><h1 style="color:#19458a"><?php echo $name;?></h1>
        <?php if ($status == 'Đang hoạt động')  echo '<h3 style="color: green; ">Đang hoạt động</h3>';
        else echo '<h3 style="color: red">Đang hoạt động</h3>'?>
    </div>
    <div class='container'>
        <div class='left-panel'>
            <div class="field-image">
                <img id="field-image" src=<?php echo $avt_pitches[0];?> alt="Sân bóng">
            </div>
            <div class="thumbnails-container">
        <div class="thumbnails" id="thumbnails">
            <?php foreach ($avt_pitches as $index => $imageSrc): ?>
                <img src="<?php echo $imageSrc; ?>" alt="Thumbnail <?php echo $index + 1; ?>" onclick="changeImage('<?php echo $imageSrc; ?>')">
            <?php endforeach; ?>
        </div>
    </div>

    <div class="scroll-buttons">
        <button onclick="scrollThumbnails(-150)">Previous</button>
        <button onclick="scrollThumbnails(150)">Next</button>
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
            <button class="button" style="background-color:#f7373a; color:yellow;" onclick="openPopup()">Đặt ngay</button>
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
        let images = <?php echo json_encode($avt_pitches); ?>;
        let currentIndex = 0;
        let thumbnailContainer = document.getElementById('thumbnails');
        let scrollButtons = document.getElementById('scroll-buttons');

        function changeImage(imageSrc) {
            let img = document.getElementById('field-image');
            img.classList.add('hidden');
            setTimeout(() => {
                img.src = imageSrc;
                img.classList.remove('hidden');
            }, 1000); // Thời gian khớp với thời gian của transition trong CSS
            console.log(imageSrc);
        }

        function autoChangeImage() {
            if (images.length > 1) { // Chỉ thay đổi hình ảnh nếu có hơn 1 hình ảnh
                currentIndex++;
                if (currentIndex >= images.length) {
                    currentIndex = 0;
                }
                changeImage(images[currentIndex]);
            }
        }

        function scrollThumbnails(amount) {
            let currentTransform = getComputedStyle(thumbnailContainer).transform;
            let matrixValues = currentTransform.match(/matrix.*\((.+)\)/);
            let currentX = matrixValues ? parseFloat(matrixValues[1].split(', ')[4]) : 0;
            let newX = currentX + amount;

            // Giới hạn cuộn không để vượt quá hình ảnh đầu tiên và cuối cùng
            let maxScrollX = (images.length - 5) * -150; // Điều chỉnh nếu số lượng hình ảnh thay đổi
            if (newX > 0) newX = 0;
            if (newX < maxScrollX) newX = maxScrollX;

            thumbnailContainer.style.transform = `translateX(${newX}px)`;
        }

        // Hiển thị các nút cuộn nếu có hơn 5 ảnh
        if (images.length > 5) {
            scrollButtons.style.display = 'flex';
        }

        // Thiết lập bộ hẹn giờ để thay đổi hình ảnh mỗi 5 giây
        setInterval(autoChangeImage, 5000);
        function openPopup() {
            document.getElementById('popup-overlay').style.display = 'block';
        }
        function closePopup() {
            document.getElementById('popup-overlay').style.display = 'none';
        }
    </script>
</body>
</html>