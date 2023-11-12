<?php
require '../Carbon/autoload.php';

use Carbon\Carbon;
use Cacbon\CarbonInterval;

$sql_lietke_dh = "SELECT * FROM orders,user WHERE orders.userid=user.userid ORDER BY id DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
$now = Carbon::now('Asia/Ho_Chi_Minh');

$sql_dh = "SELECT * FROM orders ORDER BY id DESC";
$query_dh = mysqli_query($mysqli, $sql_dh);

if ($query_dh) {
    while ($rowi = mysqli_fetch_assoc($query_dh)) {

        $invoiceDate = $rowi['ngaynhan'];
        if ($invoiceDate < $now && $rowi['status'] == '1') {
            $id = $rowi['id'];
            $sqlh = "UPDATE `orders` SET `status` = '3' WHERE id = '$id'";
            mysqli_query($mysqli, $sqlh);
            if (isset($_SESSION['quantityArray'])) {
                $quantityArray = $_SESSION['quantityArray'];

                // Thực hiện các xử lý để thêm số lượng từ $quantityArray vào bảng hóa đơn
                foreach ($quantityArray as $id_sanpham => $soluong) {
                    // Thực hiện câu truy vấn SQL để thêm số lượng vào bảng hóa đơn
                    // Ví dụ:
                    $sql = "SELECT * FROM product WHERE productid='" . $id_sanpham . "' LIMIT 1";
                    $query = mysqli_query($mysqli, $sql);
                    $rowa = mysqli_fetch_array($query);
                    $max = $rowa['soluong'];
                    mysqli_query($mysqli, "UPDATE `product` SET `soluong` = '" . ($max + $soluong) . "' WHERE `product`.`productid` = '" . $id_sanpham . "'");
                    // ... Thực hiện thêm vào bảng hóa đơn
                }

                // Xóa mảng $quantityArray khỏi session sau khi sử dụng xong
                unset($_SESSION['quantityArray']);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admincp</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="stylesheet" href="../../css/akadmin.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../css/admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../css/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../css/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../css/admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>ADMIN</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"
                        style="margin-left: 0px; padding: 7px 20px 7px 20px;"><i
                            class="fa fa-tachometer-alt me-2"></i>Thong
                        ke</a>
                    <a href="index.php?action=quanlydanhmucsp&query=them" class="nav-item nav-link"
                        style="margin-left: 0px; padding: 7px 20px 7px 20px;"><i class="fa fa-th me-2"></i>Quan ly danh
                        muc</a>
                    <a href="index.php?action=quanlysp&query=them" class="nav-item nav-link"
                        style="margin-left: 0px; padding: 7px 20px 7px 20px;"><i class="fa fa-keyboard me-2"></i>Quan ly
                        san
                        pham</a>
                    <a href="index.php?action=quanlydonhang&query=lietke" class="nav-item nav-link active"
                        style="margin-left: 0px; padding: 7px 20px 7px 20px;"><i class="fa fa-table me-2"></i>Quan ly
                        don
                        hang</a>
                    <a href="index.php?dangxuat=1" class="nav-item nav-link"
                        style="margin-left: 0px; padding: 7px 20px 7px 20px;"><i class="fa fa-chart-bar me-2"></i>Dang
                        xuat</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <!-- Table Start -->

        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Quan ly don hang</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Mã đơn hàng</th>
                                        <th scope="col">Tên khách</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số Điên thoại</th>
                                        <th scope="col">Tình trạng</th>
                                        <th scope="col">Ngày Đặt</th>
                                        <th scope="col">Ngày nhận</th>
                                        <th scope="col">Quản Lý</th>
                                        <th scope="col">In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($row = mysqli_fetch_array($query_lietke_dh)) {
                                        $i++;
                                        ?>

                                        <tr>
                                            <td>
                                                <?php echo $i ?>
                                            </td>

                                            <td>
                                                <?php echo $row['orderid'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['fullname'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['address'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['email'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['phonenumber'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo '<a href="quanlydonhang/xuly.php?status=0&code=' . $row['orderid'] . '">Đơn hàng mới</a>';
                                                } elseif ($row['status'] == 2) {
                                                    echo 'Đơn hàng đã hủy';
                                                } elseif ($row['status'] == 3) {
                                                    echo 'Đơn hàng quá hạn';
                                                } else {
                                                    echo 'Đang giao';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $row['orderdate'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['ngaynhan'] ?>
                                            </td>
                                            <td>
                                                <a
                                                    href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['orderid'] ?>">Xem
                                                    đơn hàng</a>
                                            </td>
                                            <td>

                                                <a href="quanlydonhang/inhoadon.php?code=<?php echo $row['orderid'] ?>">In
                                                    đơn hàng</a>

                                            </td>

                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Table End -->

        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../css/admin/lib/chart/chart.min.js"></script>
    <script src="../../css/admin/lib/easing/easing.min.js"></script>
    <script src="../../css/admin/lib/waypoints/waypoints.min.js"></script>
    <script src="../../css/admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../../css/admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../../css/admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../../css/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../css/admin/js/main.js"></script>
</body>

</html>