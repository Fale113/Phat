<p>Xóa Hóa Đơn</p>
<?php
session_start();
include("../config.php");

$id=$_GET['xoa'];
$sql_xoa = "UPDATE `orders` SET`status`='2' WHERE orderid = '".$id."' AND status='1' " ;
$ok=mysqli_query($mysqli,$sql_xoa);
if (isset($_SESSION['quantityArray'])) {
    $quantityArray = $_SESSION['quantityArray'];

    // Thực hiện các xử lý để thêm số lượng từ $quantityArray vào bảng hóa đơn
    foreach ($quantityArray as $id_sanpham => $soluong) {
        // Thực hiện câu truy vấn SQL để thêm số lượng vào bảng hóa đơn
        // Ví dụ:
        $sql = "SELECT * FROM product WHERE productid='" . $id_sanpham . "' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    $max=$row['soluong'];
        mysqli_query($mysqli,"UPDATE `product` SET `soluong` = '" . ($max + $soluong) . "' WHERE `product`.`productid` = '" . $id_sanpham . "'");
        // ... Thực hiện thêm vào bảng hóa đơn
    }

    // Xóa mảng $quantityArray khỏi session sau khi sử dụng xong
    unset($_SESSION['quantityArray']);
}
header('Location:../index.php?action=quanlydonhang&query=lietke');