<?php
session_start();
include 'header.php';
require_once __DIR__ . '/../BLL/pitchService.php';
require_once __DIR__ . '/../BLL/orderService.php';

if (isset($_SESSION['selectedPitch'])) {
    $pitch = $_SESSION['selectedPitch'];
    $pitch_details = getPitch($pitch);
    unset($_SESSION['selectedPitch']);
} else {
    echo 'No pitch selected.';
    die("");
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = 1;
}

$date_now = date('Y-m-d');
$name = $pitch_details['name'];
$time_open = $pitch_details['time_start'];
$time_close = $pitch_details['time_end'];
$avt_pitches = getPichesDetails($pitch_details['id']);
$status = $pitch_details['is_maintenance'] == 0 ? 'Đang hoạt động' : 'Đang bảo trì';
$volume = $pitch_details['quantity'];
$price_perhour = $pitch_details['price_per_hour'];
$price_perpeak = $pitch_details['price_per_peak_hour'];
$times = getTimeOrder($user_id, $pitch_details['id']);
$note = $pitch_details['description'];
$type_note = $pitch_details['type_note'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin - <?php echo $name; ?></title>
    <link rel="stylesheet" href="css/pitchDetail.css?v= <?php echo time() ?>">
    <style>
    /* Thêm CSS tùy chỉnh nếu cần */
    </style>
</head>

<body>
    <div>
        <h1 style="color:#19458a; text-align:center;"><?php echo $name; ?></h1>
        <?php if ($status == 'Đang hoạt động') echo '<h3 style="color: green; margin-left: 10% ">Đang hoạt động</h3>';
        else echo '<h3 style="color: red; margin-left: 10% ">Đang bảo trì</h3>' ?>
    </div>
    <div class='container'>
        <div class='left-panel'>
            <div class="field-image">
                <img id="field-image" src=<?php echo $avt_pitches[0]; ?> alt="Sân bóng">
            </div>
            <div class="thumbnails-container">
                <div class="thumbnails" id="thumbnails">
                    <?php foreach ($avt_pitches as $index => $imageSrc) : ?>
                    <img src="<?php echo $imageSrc; ?>" alt="Thumbnail <?php echo $index + 1; ?>"
                        onclick="changeImage('<?php echo $imageSrc; ?>')">
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="scroll-buttons">
                <button onclick="scrollThumbnails(-150)">Previous</button>
                <button onclick="scrollThumbnails(150)">Next</button>
            </div>
        </div>
        <div class='right-panel'>
            <h1 style="text-align: center;">Thông tin</h1>
            <div class="field-info">
                <label>Tên sân: </label>
                <span><?php echo $name; ?></span>
            </div>
            <div class="field-info">
                <label>Tình trạng: </label>
                <span><?php echo $status; ?></span>
            </div>
            <div class="field-info">
                <label>Số người: </label>
                <span><?php echo $volume; ?> người</span>
            </div>
            <div class="field-info">
                <label>Giá tiền: </label>
                <span><?php echo $price_perhour . 'đ - ' . $price_perpeak . 'đ'; ?></span>
            </div>
            <div class="field-info">
                <label>Thời gian mở - đóng: </label>
                <span><?php echo $time_open . ' - ' . $time_close; ?></span>
            </div>
            <div class="field-info">
                <label>Số lần đặt: </label>
                <span><?php echo $times; ?></span>
            </div>
            <div class="field-info description">
                <label>Mô tả</label>
                <span style="text-align:justify"><?php echo $note; ?></span>
            </div>
            <div class="field-info">
                <label>Sân liên kết</label>
            </div>
            <button class="button" style="background-color:#f7373a; color:yellow; margin-top:10px"
                onclick="openPopup()">Đặt
                ngay</button>
            <button class="button">Xem thời gian sân đã đặt</button>

            <div id="popup-overlay" class="overlay">
                <div class="popup">
                    <h1>Đặt sân</h1>
                    <p style="margin-bottom: 20px;">Đặt sân bóng đá tại đây!</p>
                    <form action="pitchOrder.php" method="post">
                        <table>
                            <tr>
                                <td><label for="date">Chọn ngày</label></td>
                                <td><input type="date" name="date" value=<?php echo $date_now ?>></td>
                            </tr>
                            <tr>
                                <td><label for="start_time">Chọn giờ bắt đầu</label></td>
                                <td><input type="time" name="start_time" value="07:00" step="3600"></td>
                            </tr>
                            <tr>
                                <td><label for="end_time">Chọn giờ kết thúc</label></td>
                                <td><input type="time" name="end_time" value="07:00" step="3600"></td>
                            </tr>
                            <tr style="margin-top: 30px;">
                                <td><label for="name">Họ và tên (*)</label></td>
                                <td><input type="text" name="name" required></td>
                            </tr>
                            <tr>
                                <td><label for="code">Mã giảm giá</label></td>
                                <td><input type="text" name="code"></td>
                            </tr>
                            <tr>
                                <td><label for="phone">Số điện thoại (*)</label></td>
                                <td><input type="tel" name="phone" required></td>
                            </tr>
                            <tr>
                                <td><label for="email">Email</label></td>
                                <td><input type="email" name="email"></td>
                            </tr>
                            <input type="hidden" name="pitch_details_id" value="<?php echo $pitch_details['id'] ?>">
                            <input type="hidden" name="price_perhour" value="<?php echo $price_perhour ?>">
                            <input type="hidden" name="price_perpeak" value="<?php echo $price_perpeak ?>">
                        </table>
                        <div>
                            <input type="submit" name='submit' value="Đặt sân">
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
<?php
include 'footer.php';
?>