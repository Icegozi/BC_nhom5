<?php
require_once __DIR__ . '/../BLL/pitchSearchService.php';
$service = new PitchSearchService();
$emptyPitches = $service->getEmptyPitch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search for vacant soccer fields</title>
    <style>
    body {
        margin: 0px;
        padding: 0px;
        font-family: Arial, sans-serif;
    }

    h2 {
        text-align: center;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 25px;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .info_pitch {
        flex: 1 1 calc(33.33% - 20px);
        /* Mỗi sân bóng chiếm 33.33% chiều rộng của container, trừ khoảng cách */
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
        /* Ẩn phần dư thừa của hình ảnh nếu có */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        display: flex;
        /* Sử dụng flexbox để căn chỉnh hình ảnh và thông tin */
        margin-bottom: 20px;
        /* Khoảng cách dưới mỗi sân bóng */
        position: relative;
        /* Để có thể định vị phần button */
    }

    .info_pitch:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .info_pitch img {
        width: 50%;
        height: 100%;
        object-fit: cover;
        /* Đảm bảo hình ảnh không bị biến dạng và điền đầy phần tử */
        border-radius: 4px 4px 0 0;
        /* Bo tròn góc chỉ ở trên cùng của hình ảnh */
    }

    .info_show {
        flex: 1;
        /* Để phần thông tin chiếm phần còn lại của .info_pitch */
        padding: 15px;
    }

    .info_show p {
        margin: 5px 0;
        font-size: 16px;
        line-height: 1.6;
        word-break: break-word;
        overflow: hidden;
    }

    .button-container {
        position: absolute;
        bottom: 10px;
        left: 15px;
        /* Để căn chỉnh button ở góc dưới bên trái */
    }

    .button-container button {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button-container button:hover {
        background-color: #45a049;
    }

    @media (max-width: 1200px) {
        .info_pitch {
            flex: 1 1 calc(50% - 20px);
            /* Nếu màn hình nhỏ hơn hoặc bằng 1200px, mỗi sân bóng chiếm 50% */
        }
    }

    @media (max-width: 768px) {
        .info_pitch {
            flex: 1 1 calc(100% - 20px);
            /* Nếu màn hình nhỏ hơn hoặc bằng 768px, mỗi sân bóng chiếm 100% */
        }
    }

    .title_name {
        font-weight: 700;
    }
    </style>
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
                    <button>Book Now</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else : ?>
        <p>No vacant soccer fields found.</p>
        <?php endif; ?>
    </div>
</body>

</html>