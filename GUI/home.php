<?php
require_once __DIR__ . '/../BLL/pitchSearchService.php';
$service = new PitchSearchService();
$emptyPitches = $service->getAllPitches();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pitchId = $_POST['pitchId'];
    $_SESSION['selectedPitch'] = $pitchId;
    header('Location: pitchDetail.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search for vacant soccer fields</title>
    <link rel="stylesheet" href="css/home.css?v= <?php echo time() ?>">
</head>

<body>
    <h2 class="title">ALL SOCCER FIELDS</h2>
    <div class="container">
        <?php if (!empty($emptyPitches)) : ?>
        <?php foreach ($emptyPitches as $pitch) : ?>
        <div class="info_pitch">
            <img src="img/pitch.jpg" alt="hình anh">
            <div class="info_show">
                <p class="title_name">Pitch name: </p>
                <p><?php echo $pitch->name; ?></p>
                <p class="title_name">Time open: </p>
                <p><?php echo $pitch->start_time .' - '.$pitch->end_time; ?></p>
                <p class="title_name">Price per hour: </p>
                <p><?php echo $pitch->price_per_hour . " VND"; ?></p>
                <p class="title_name">Price per peak hour:</p>
                <p><?php echo $pitch->price_per_peak_hour . " VND"; ?></p>
                <div class="button-container">
                    <form method="post">
                        <input type="hidden" name="pitchId" value="<?php echo $pitch->id ?>">
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