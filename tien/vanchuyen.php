<style>
* {
    font-family: 'Roboto', sans-serif;
}

legend {
    margin-top: 13px;

}

.container {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-top: 10px;
    margin-bottom: 10px;
    padding-right: 40px;
    padding-left: 40px;
    color: #1435c3;
    background-color: #ffffff;
}

.btn-success {
    margin-bottom: 10px;
}

.n1 {
    width: 50%;
    float: left;
    padding-right: 40px;
}

.n2 {
    width: 50%;
    float: right;
    padding-right: 40px;
}

.form-control {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
}

.rounded {
    border-radius: 10px;
    height: 50px;

}

.capnhat {
    margin-left: 40px;
    background-color: #1435c3;

}

table {

    width: 100%;
    border-collapse: collapse;
    background-color: white;

    border: 0;



}

th,
td {
    padding: 8px;
    text-align: left;
    border-top: 1px solid #dee2e6;
    border: 0;
}

h2 {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    background-color: #f2f2f2;
    color: mediumblue;
    font-size: 30px;
    margin-bottom: 5px;
    text-align: center;

}

tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
}

.nut_dang_nhap {
    background-color: rgb(20, 53, 195);
    font-size: 20px;
    width: 80%;
    height: 50px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    border: none;
    margin-left: 40px;
    color: white;
}


.nut_xoa {
    width: 120px;
    height: 30px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    background-color: #ff3300;
    color: #ffebe6;
    border: none;
}

.xoa_1 {
    background-color: #ff3300 !important;
    width: 50px;
    height: 25px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    border: none;
    background-color: rgb(20, 53, 195);
    color: white;

}

.tang_giam {
    width: 20px;
    height: 20px;
    background-color: rgb(20, 53, 195);
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    border: none;
    color: white;

}

#bass {
    height: 40px;
    text-align: center;
    font-size: 40px;
    color: blue;
    margin-top: 30px;
}

.o_thanh_toan {

    width: 26%;
    height: 270px;
    background-color: #f2f2f2;
    float: right;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;


}

.arrow-steps {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.step {
    flex: 1;
    text-align: center;
    padding: 10px;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.tien {
    font-size: 20px;
    margin-left: 10px;
}

#so_tien {
    color: blue;
    float: right;
    margin-right: 20px;
}
</style>

<div class="container">
    <!-- Responsive Arrow Progress Bar -->
    <div class="arrow-steps clearfix">
        <div class="step "> <span> <a href="index.php?quanly=giohang">GIỎ HÀNG</a></span> </div>
        <div class="step current"> <span><a href="index.php?quanly=vanchuyen">VẬN CHUYỂN</a></span> </div>
        <div class="step"> <span><a href="">NGÀY NHẬN</a><span> </div>
        <div class="step"> <span><a href="">THANH TOÁN</a><span> </div>
    </div>
    <legend>THÔNG TIN VẬN CHUYỂN</legend>
    <?php
   if(isset($_POST['capnhatvanchuyen'])){
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $note=$_POST['note'];
        $userid= $_SESSION['userid'];
        $sql_update_vanchuyen = mysqli_query($mysqli,"UPDATE shipping SET khach='$name', sodt='$phone', diachi='$address', note='$note', dangkyid='$userid' WHERE dangkyid= '$userid'");
    if($sql_update_vanchuyen){
      echo '<script>alert("Cập nhật vận chuyển thành công")</script>';
    }
  }
  ?>
    <div class="row">
        <?php
        $userid = $_SESSION['userid'];
        $sql=mysqli_query($mysqli,"SELECT * FROM user WHERE userid= '$userid' LIMIT 1");
    $sql_get_vanchuyen = mysqli_query($mysqli,"SELECT * FROM shipping WHERE dangkyid= '$userid' LIMIT 1");
    $count = mysqli_num_rows($sql_get_vanchuyen);
    if($count > 0){
      $row_get_vanchuyen =mysqli_fetch_array($sql_get_vanchuyen);
      $name=$row_get_vanchuyen['khach'];
      $phone=$row_get_vanchuyen['sodt'];
      $address=$row_get_vanchuyen['diachi'];
      $note=$row_get_vanchuyen['note'];
    }else{
      $row_get =mysqli_fetch_array($sql);
      $name=$row_get['fullname'];
      $phone=$row_get['phonenumber'];
      $address=$row_get['address'];
      $note='';
    }  
    ?>
        <div class="col-md-12">
            <form action="" autocomplete="off" method="POST">

                <div class="form-group n1">
                    <label for="email">Họ và tên</label>
                    <input type="text" name="name" class="form-control rounded " value="<?php echo $name ?>"
                        placeholder="...">
                </div>
                <div class="form-group n2">
                    <label for="email">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control rounded " value="<?php echo $phone ?>"
                        placeholder="...">
                </div>

                <div class="form-group">
                    <label for="email">Địa chỉ</label>
                    <input type="text" name="address" class="form-control rounded" value="<?php echo $address ?>"
                        placeholder="...">
                </div>
                <div class="form-group">
                    <label for="email">Ghi chú</label>
                    <input type="text" name="note" class="form-control rounded" style="height: 100px;"
                        value="<?php echo $note ?>" placeholder="...">
                </div>

                <button type="submit" name="capnhatvanchuyen" class="btn btn-success capnhat"
                    style="background-color: #1435c3;">Cập nhật vận
                    chuyển</button>

            </form>
        </div>
    </div>
    <!----------------Gio hang----------------------->
    <table>
        <tr>
            <th>Id</th>
            <th>Mã sp</th>
            <th>Tên sản phẩm</th>
            <th>Hình minh họa</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Thành tiền</th>

        </tr>
        <?php
    if (isset($_SESSION['cart'])) {
        $i = 0;
        $tongtien = 0;
        foreach ($_SESSION['cart'] as $cart_item) {
            $thanhtien = $cart_item['soluong'] * $cart_item['gia'];
            $tongtien += $thanhtien;
            $i++;

            ?>
        <tr>
            <td>
                <?php echo $i; ?>
            </td>
            <td>
                <?php echo $cart_item['categoryid']; ?>
            </td>
            <td>
                <?php echo $cart_item['tensanpham']; ?>
            </td>
            <td><img src="../image/<?php echo $cart_item['thumbnail']; ?>" alt="" width="150px" height="150px"></td>
            <td>

                <?php echo $cart_item['soluong']; ?>

            </td>
            <td>
                <?php echo number_format($cart_item['gia'], 0, ',', '.') . 'vnd'; ?>
            </td>
            <td>
                <?php echo number_format($thanhtien, 0, ',', '.') . 'vnd'; ?>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="8">~
                <p style="float:left;">Tổng tiền:
                    <?php echo number_format($tongtien, 0, ',', '.') . 'vnd' ?>
                </p><br />

                <div style="clear:both;"></div>
                <?php
                if (isset($_SESSION['dangky'])) {
                    ?>
                <p><a href="index.php?quanly=donhangdadat" class="btn btn-danger"
                        style="align-items: center;background-color: #1435c3;">Thanh
                        Toán</a></p>
                <?php
                }?>
            </td>


        </tr>
        <?php
    } 
    ?>
    </table>
</div>
<!-- fghjkjhvgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggh -->