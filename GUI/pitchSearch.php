<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Bắt đầu session nếu chưa tồn tại
}
require_once __DIR__ . '/../BLL/pitchSearchService.php';
$service = new PitchSearchService();
$emptyPitches = $service->getEmptyPitch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Khi button "Book Now" được nhấn, lưu thông tin sân bóng vào session
    $pitchId = $_POST['pitchId'];
    $_SESSION['selectedPitch'] = $service->getPitchById($pitchId);
    header('Location: #');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search for vacant soccer fields</title>
    <link rel="stylesheet" href="css/pitchSearch.css?v= <?php echo time() ?>">
</head>

<body>
    <h2 class="title">PITCH SEARCH</h2>
    <div class="container">
        <?php if (!empty($emptyPitches)) : ?>
        <?php foreach ($emptyPitches as $pitchId) : ?>
        <div class="info_pitch">
            <img src="img/pitch.jpg" alt="hình anh">
            <div class="info_show">
                <p class="title_name">Pitch name: </p>
                <p><?php echo $pitchId->name; ?></p>
                <p class="title_name">Time open: </p>
                <p><?php echo $pitchId->start_time .' - '.$pitchId->end_time; ?></p>
                <p class="title_name">Price per hour: </p>
                <p><?php echo $pitchId->price_per_hour . " VND"; ?></p>
                <p class="title_name">Price per peak hour:</p>
                <p><?php echo $pitchId->price_per_peak_hour . " VND"; ?></p>
                <div class="button-container">
                    <form method="post">
                        <input type="hidden" name="pitchId" value="<?php echo $pitchId->id ?>">
                        <button type="submit">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else : ?>
        <h3 align="center">No vacant soccer fields found.</h3>
        <?php endif; ?>
    </div>
</body>

</html>