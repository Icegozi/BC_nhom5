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
</head>

<body>
    <div class="pitch-detail-page">
        <div class="container">
            <div class="image-gallery">
                <div class="main-image">
                    <img id="field-image" src="<?php echo $avt_pitches[0]; ?>" alt="Sân bóng">
                </div>
                <div class="thumbnails-container">
                    <div class="thumbnails" id="thumbnails">
                        <?php foreach ($avt_pitches as $index => $imageSrc) : ?>
                        <img src="<?php echo $imageSrc; ?>" alt="Thumbnail <?php echo $index + 1; ?>"
                            onclick="changeImage('<?php echo $imageSrc; ?>')">
                        <?php endforeach; ?>
                    </div>
                    <div class="scroll-buttons" id="scroll-buttons">
                        <button onclick="scrollThumbnails(-150)">Previous</button>
                        <button onclick="scrollThumbnails(150)">Next</button>
                    </div>
                </div>
            </div>
            <div class="details-panel">
                <h1 class="pitch-name"><?php echo $name; ?></h1>
                <div class="status" style="color: <?php echo $status == 'Đang hoạt động' ? 'green' : 'red'; ?>">
                    <?php echo $status; ?>
                </div>
                <div class="pitch-details">
                    <div class="detail-item">
                        <span class="label">Amount of people:</span>
                        <span class="value"><?php echo $volume; ?> people</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Price:</span>
                        <span class="value"><?php echo $price_perhour . 'đ - ' . $price_perpeak . 'đ'; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Opening - closing time:</span>
                        <span class="value"><?php echo $time_open . ' - ' . $time_close; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Number of orders:</span>
                        <span class="value"><?php echo $times; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Describe:</span>
                        <span class="value"><?php echo $note; ?></span>
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="button primary" onclick="openPopup()">Book now</button>
                    <button class="button secondary">View ordered yard times</button>
                </div>
            </div>

        </div>

        <div id="popup-overlay" class="overlay">
            <div class="popup">
                <h1>Order</h1>
                <form action="pitchOrder.php" method="post">
                    <table>
                        <tr>
                            <td><label for="date">Select date</label></td>
                            <td><input type="date" name="date" value="<?php echo $date_now; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="start_time">Select start time</label></td>
                            <td><input type="time" name="start_time" value="07:00" step="3600"></td>
                        </tr>
                        <tr>
                            <td><label for="end_time">Select end time</label></td>
                            <td><input type="time" name="end_time" value="07:00" step="3600"></td>
                        </tr>
                        <tr>
                            <td><label for="name">Full name (*)</label></td>
                            <td><input type="text" name="name" required></td>
                        </tr>
                        <tr>
                            <td><label for="code">Discount code</label></td>
                            <td><input type="text" name="code"></td>
                        </tr>
                        <tr>
                            <td><label for="phone">Phone number (*)</label></td>
                            <td><input type="tel" name="phone" required></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="email" name="email"></td>
                        </tr>
                        <input type="hidden" name="pitch_details_id" value="<?php echo $pitch_details['id']; ?>">
                        <input type="hidden" name="price_perhour" value="<?php echo $price_perhour; ?>">
                        <input type="hidden" name="price_perpeak" value="<?php echo $price_perpeak; ?>">
                    </table>
                    <div class="popup-actions">
                        <input type="submit" name='submit' value="Book now" class="button primary">
                        <button type="button" class="button secondary" onclick="closePopup()">Close</button>
                    </div>
                </form>
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
        }, 1000);
    }

    function autoChangeImage() {
        if (images.length > 1) {
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
        let maxScrollX = (images.length - 5) * -150;
        if (newX > 0) newX = 0;
        if (newX < maxScrollX) newX = maxScrollX;
        thumbnailContainer.style.transform = `translateX(${newX}px)`;
    }

    if (images.length > 5) {
        scrollButtons.style.display = 'flex';
    }

    setInterval(autoChangeImage, 5000);

    function openPopup() {
        document.getElementById('popup-overlay').style.display = 'flex';
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