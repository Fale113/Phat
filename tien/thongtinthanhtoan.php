<!-- ------------------------------------------------code thử--------------------------------------------------------->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
    <style>
    * {
        font-family: 'Roboto', sans-serif;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
        margin-bottom: 20px;
    }

    .thongtin {
        padding: 20px;
        margin-left: 20px;
    }

    .thank-you-message {
        font-size: 20px;
        color: #666;
        margin-bottom: 30px;
    }

    .ok-button {
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 10px;
        cursor: pointer;
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
        margin-top: 30px;
    }

    .thank-you-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .thank-you-popup {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        text-align: center;
    }

    /* Styling for the progress bar */
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

    .current {
        background-color: #1435c3;
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="container">
        <!-- Responsive Arrow Progress Bar -->
        <div class="arrow-steps clearfix">
            <div class="step "> <span> <a href="index.php?quanly=giohang">GIỎ HÀNH</a></span> </div>
            <div class="step"> <span><a href="index.php?quanly=vanchuyen">VẬN CHUYỂN</a></span> </div>
            <div class="step "> <span><a href="index.php?quanly=donhangdadat">NGÀY NHẬN</a><span> </div>
            <div class="step current"> <span><a href="index.php?quanly=thongtinthanhtoan">THANH TOÁN</a><span>
            </div>

        </div>

        <div class="row">

            <?php
            $id_dangky = $_SESSION['userid'];
            $sql=mysqli_query($mysqli,"SELECT * FROM shipping,orders WHERE orders.ship=shipping.shipid AND shipping.dangkyid='$id_dangky' ORDER BY id DESC LIMIT 1");
   
            if ($sql) {
                $row_get_vanchuyen = mysqli_fetch_array($sql);
                if($row_get_vanchuyen>0){
                $name = $row_get_vanchuyen['khach'];
                $phone = $row_get_vanchuyen['sodt'];
                $address = $row_get_vanchuyen['diachi'];
                $note = $row_get_vanchuyen['note'];
                $ngaydat=$row_get_vanchuyen['ngaynhan'];
                $ngay = date("d/m/Y", strtotime($ngaydat));
            }
        }
            ?>
            <div class="col-md-8">
                <legend>THÔNG TIN NGƯỜI ĐẶT HÀNG</legend>

                <div class="thongtin">Họ Và Tên : <b>
                        <?php echo $name ?>
                    </b></div>
                <div class="thongtin">Số Điện Thoại :<b>
                        <?php echo $phone ?>
                    </b></div>
                <div class="thongtin">Địa Chỉ : <b>
                        <?php echo $address ?>
                    </b></div>
                <div class="thongtin">Ghi Chú :<b>
                        <?php echo $note ?>
                    </b></div>
                <div class="thongtin">Ngày Nhận :<b>
                        <?php echo $ngay ?>
                    </b></div>


            </div>


            <script>
            document.addEventListener("DOMContentLoaded", function() {
                var okButton = document.getElementById("ok-button");
                var thankYouContainer = document.getElementById("thank-you-container");

                okButton.addEventListener("click", function() {
                    thankYouContainer.style.display = "flex";
                    setTimeout(function() {
                        thankYouContainer.style.display = "none";
                        window.location.href =
                            "index.php"; // Thay đổi "index.html" thành đường dẫn tới trang index thực tế của bạn
                    }, 3000); // Chuyển hướng sau 3 giây (có thể điều chỉnh thời gian tùy ý)
                });
            });
            </script>

            <button class="ok-button" id="ok-button" style="background-color: #1435c3;margin-top: 30px;width: 50%;">Hoàn
                Tất
                Đặt
                Hàng</button>

            <div id="thank-you-container" class="thank-you-container">
                <div class="thank-you-popup">
                    <p class="thank-you-message">Cảm ơn bạn đã đồng ý!</p>
                    <p>Bạn sẽ được chuyển hướng đến trang chính sau vài giây...</p>
                </div>
            </div>
            </form>
        </div>
</body>

</html>