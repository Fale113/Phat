<?php
$code =$_GET['code'];
$sql_lietke_dh = "SELECT * FROM ordersdetail,product WHERE ordersdetail.productid=product.productid AND ordersdetail.orderid='$_GET[code]' ORDER BY ordersdetail.orderdtid DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>

<p>Liet kee</p>
<table style="width: 100%" border="1" style=" border-collapse: collapse;">

    <tr>
        <th>Id</th>
        <th>Mã đơn hàng</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành Tiền</th>
    </tr>
    <?php
    $i = 0;
    $tongtien = 0;
    $thanhtien = 0;
    while ($row = mysqli_fetch_array($query_lietke_dh)) {
        $i++;
        $thanhtien = $row['price'] * $row['num'];
        $tongtien += $thanhtien;
        ?>
    <tr>
        <td>
            <?php echo $i ?>
        </td>

        <td>
            <?php echo $row['orderid'] ?>
        </td>
        <td>
                <?php echo $row['tensanpham'] ?>
        </td>
        <td>
            <?php echo $row['soluongmua'] ?>
        </td>
        <td>
            <?php echo number_format($row['giasanpham'], 0, ',', '.') . 'vnd' ?>
        </td>
        <td>
            <?php echo number_format($thanhtien, 0, ',', '.') . 'vnd' ?>
        </td>


    </tr>

    <?php }
    ?>
    <tr>
        <td colspan="6">
            <p>Tổng tiền:
                <?php echo number_format($tongtien, 0, ',', '.') . 'vnd' ?>
            </p>

        </td>
    </tr>
</table>