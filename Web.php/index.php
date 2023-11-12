<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF=8">
    <title>layout css</title>
    <link rel="stylesheet" href="../css/ak.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js.js/timkiem.js"></script>
    <script src="../js.js/timkiem.js"></script>
    <script src="https://kit.fontawesome.com/fec980010a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=65328dc883bf3608440f3153"
        async="async"></script>

</head>

<body>

    <div class="wrapper">
        <?php

        session_start();
        include("../admin/config.php");
        include("header.php");
        include("menu.php");
        include("main.php");
        include("footer.php");
        ?>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {

var back = $(".prev");
var next = $(".next");
var steps = $(".step");

next.bind("click", function() {
  $.each(steps, function(i) {
    if (!$(steps[i]).hasClass('current') && !$(steps[i]).hasClass('done')) {
      $(steps[i]).addClass('current');
      $(steps[i - 1]).removeClass('current').addClass('done');
      return false;
    }
  })
});
back.bind("click", function() {
  $.each(steps, function(i) {
    if ($(steps[i]).hasClass('done') && $(steps[i + 1]).hasClass('current')) {
      $(steps[i + 1]).removeClass('current');
      $(steps[i]).removeClass('done').addClass('current');
      return false;
    }
  })
});

})
</script>
</body>

</html>