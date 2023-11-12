<!-- ---------------------------------------- -->



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Quá trình đặt hàng</title>
    <style>
    * {
        font-family: 'Roboto', sans-serif;
    }

    body {
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
    }

    .nhom form {
        padding: 20px;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="date"] {
        padding: 10px;
        border-radius: 10px;
        border: 1px solid #ccc;
        width: 100%;
        margin-bottom: 10px;
    }

    input[type="submit"] {
        padding: 10px 20px;
        background-color: #1435c3;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0e2c9b;
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
            <div class="step current"> <span><a href="index.php?quanly=donhangdadat">NGÀY NHẬN</a><span> </div>
            <div class="step"> <span><a href="">THANH TOÁN</a><span> </div>
        </div>

        <form class="nhom" method="POST" action="../main/nhapngay.php">
            <h2>Ngày Nhận Hàng</h2>
            <label for="delivery_date">Chọn Ngày Nhận Hàng:</label>
            <input type="date" id="delivery_date" name="delivery_date" required>
            <br><br>
            <label for="payment-method">Phương thức thanh toán:</label>
            <div id="payment-method" name="payment-method">
                <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="tien mat"
                    checked>
                <label class="form-check-label" for="exampleRadios1">
                    TIỀN MẶT
                </label>

                <input class="form-check-input" type="radio" name="payment" id="exampleRadios2" value="chuyen khoan">
                <label class="form-check-label" for="exampleRadios2">
                    CHUYỂN KHOẢN
                </label>
            </div>
            <br>
            <input class="gui" type="submit" value="Gửi" name="date">
        </form>
    </div>
    <script>
    // JavaScript code (if needed)
    var currentDate = new Date().toISOString().split("T")[0];
    document.getElementById("delivery_date").min = currentDate;
    </script>
</body>

</html>