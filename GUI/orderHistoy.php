<?php
require_once '../dal/orderData.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu cầu bảng</title>
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <style>
        .card {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }

        .nav-link {
            border: none;
            border-bottom: 2px solid transparent;
            color: #495057;
            transition: all 0.3s;
        }

        .nav-link.active {
            border-color: #007bff;
            color: #007bff;
        }

        .tab-pane {
            padding-top: 20px;
        }
    </style>
</head>

<body>
  
    <section class="section">
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="card-title">Yêu cầu bảng</h5>
                
                <ul class="nav nav-tabs nav-tabs-bordered mb-2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                            aria-controls="all" aria-selected="true" role="tab">Tất cả</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="order-unpay-tab" data-bs-toggle="tab"
                            data-bs-target="#order-unpay" aria-controls="order-unpay" aria-selected="false"
                            role="tab">Các sân sắp hết</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="advantage-tab" data-bs-toggle="tab" data-bs-target="#advantage"
                            aria-controls="advantage" aria-selected="false" role="tab">Tùy chỉnh</button>
                    </li>
                </ul>

                <div class="tab-content pt-2">
                   
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                        <table id="table_order" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Bắt đầu lúc</th>
                                    <th>Kết thúc lúc</th>
                                    <th>Tiền cọc</th>
                                    <th>Tổng tiền</th>
                                    <th>Mã code đặt sân</th>
                                    <th>Tình trạng</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Lấy danh sách các order và hiển thị
                                $orders = getAllOrders(); 

                                foreach ($orders as $order) {
                                    echo "<tr>";
                                    echo "<td>{$order['id']}</td>";
                                    echo "<td>{$order['name']}</td>";
                                    echo "<td>{$order['phone']}</td>";
                                    echo "<td>{$order['email']}</td>";
                                    echo "<td>{$order['start_at']}</td>";
                                    echo "<td>{$order['end_at']}</td>";
                                    echo "<td>{$order['deposit']}</td>";
                                    echo "<td>{$order['total']}</td>";
                                    echo "<td>{$order['code']}</td>";
                                    echo "<td>";
                                   
                                    if ($order['status'] == 1) {
                                        echo "<span style='color: green;'>Đang đá</span>";
                                    } elseif ($order['status'] == 2) {
                                        echo "<span style='color: red;'>Chuẩn bị kết thúc</span>";
                                    } elseif ($order['status'] == 3) {
                                        echo "<span style='color: orange;'>Kết thúc</span>";
                                    } else {
                                        echo "Đã đặt";
                                    }
                                    echo "</td>";
                                    echo "<td><a href='#'>Edit</a></td>"; 
                                    echo "<td><a href='#'>Delete</a></td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


                    <div class="tab-pane fade" id="order-unpay" role="tabpanel" aria-labelledby="order-unpay-tab">
                        <table id="table_order_unpaid" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Bắt đầu lúc</th>
                                    <th>Kết thúc lúc</th>
                                    <th>Tiền cọc</th>
                                    <th>Tổng tiền</th>
                                    <th>Mã code đặt sân</th>
                                    <th>Tình trạng</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Lấy danh sách các order chưa thanh toán và hiển thị
                                $unpaidOrders = getUnpaidOrders(); 

                                foreach ($unpaidOrders as $order) {
                                    echo "<tr>";
                                    echo "<td>{$order['id']}</td>";
                                    echo "<td>{$order['name']}</td>";
                                    echo "<td>{$order['phone']}</td>";
                                    echo "<td>{$order['email']}</td>";
                                    echo "<td>{$order['start_at']}</td>";
                                    echo "<td>{$order['end_at']}</td>";
                                    echo "<td>{$order['deposit']}</td>";
                                    echo "<td>{$order['total']}</td>";
                                    echo "<td>{$order['code']}</td>";
                                    echo "<td>";
                                    
                                    if ($order['status'] == 1) {
                                        echo "<span style='color: green;'>Đang đá</span>";
                                    } elseif ($order['status'] == 2) {
                                        echo "<span style='color: red;'>Chuẩn bị kết thúc</span>";
                                    } elseif ($order['status'] == 3) {
                                        echo "<span style='color: orange;'>Kết thúc</span>";
                                    } else {
                                        echo "Đã đặt";
                                    }
                                    echo "</td>";
                                    echo "<td><a href='#'>Edit</a></td>";
                                    echo "<td><a href='#'>Delete</a></td>"; 
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                 
                    <div class="tab-pane fade" id="advantage" role="tabpanel" aria-labelledby="advantage-tab">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                            <button type="submit" class="btn btn-danger mb-2">Xóa các yêu cầu hủy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-EbQFXH/Obb5Cw9tQFfPzgPKTFiJhB2tlEQ7S1FW7IKy6exob5lV7wYUlCZ+LxqW" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-H8w1nbOuhTFj6hNj+/yLi4+AX3tHUyK/HCE7C8F2CZlZ0v9EpfvRzRbAdbfmU1eN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_order').DataTable();
            $('#table_order_unpaid').DataTable();
        });
    </script>
</body>

</html>
