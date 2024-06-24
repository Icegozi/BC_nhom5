<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <style>
    .container {
        width: 80%;
        margin: 0 auto;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        background-color: #D3DCE3;
    }

    .section {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .info-box {
        width: 48%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .info-box h3 {
        margin-top: 0;
    }

    .footer {
        background-color: #f1f1f1;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        background-color: #76A2D8;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Thông tin đặt sân</h2>
        </div>

        <?php
        require_once '../BLL/orderService.php';
       
       if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Bắt đầu session nếu chưa tồn tại
        }
        if (isset($_SESSION['order_id'])) {
            $order_id = $_SESSION['order_id'];
        }
        else {
            die("Sorry, not found order");
        }
        $pitch_id = $_SESSION["pitch_id"];
        $name = $_SESSION["name_pitch"];
        $quantity = $_SESSION["quantity_pitch"];
        $name_user = $_SESSION["name_user"];
        $email = $_SESSION["email"];
        $start_time = $_SESSION["start_time"];
        $end_time = $_SESSION["end_time"];
        $phone = $_SESSION["phone"];
        $data = getOrder($order_id);
        
        $ten_san = $name . " | " . $quantity . "người";
        $total = $data["total"];
        // Các thông tin chuyển khoản
        $so_tien = $data["deposit"] . " - " . $total;
        $note = $data["note"];
        $data_bank = getBill();
        ?>

        <div class="section">
            <div class="info-box">
                <h3>Thông tin đặt sân</h3>
                <p><strong>Tên sân:</strong> <?php echo $ten_san; ?></p>
                <p><strong>Mã sân:</strong> <?php echo $pitch_id; ?></p>
                <p><strong>Người đặt:</strong> <?php echo $name_user; ?></p>
                <p><strong>Số điện thoại:</strong> <?php echo $phone; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Thời gian đặt:</strong> <?php echo $start_time; ?></p>
                <p><strong>Thời gian kết thúc:</strong> <?php echo $end_time; ?></p>
                <p><strong>Tổng tiền:</strong> <?php echo $total; ?></p>
            </div>
            <div class="info-box">
                <h3>Thông tin chuyển</h3>
                <p><strong>Số tiền:</strong> <?php echo $so_tien; ?></p>
                <p><strong>Nội dung:</strong> <?php echo $note; ?></p>
                <p><strong>Số tài khoản:</strong> <?php echo $data_bank[0]["bank_number"]; ?></p>
                <p><strong>Ngân hàng:</strong> <?php echo $data_bank[0]["name"]; ?></p>
                <!-- QR code sẽ được thêm vào đây -->
                <img style="height: 150px; width: auto;" src="<?php echo $data_bank[0]["image"];?>" alt="QR Code">
            </div>
        </div>

        <div class="footer">
            <p>Nếu sau khi chuyển khoản thành công quá 5 phút mà vẫn chưa được thông báo đặt sân thành công. Vui lòng
                liên hệ số điện thoại bên dưới.</p>
            <p style="color:#FD0101">01887090085</p>
        </div>
    </div>
</body>

</html>

<?php
include 'footer.php';
?>