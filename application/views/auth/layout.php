<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>NA | <?= $title; ?></title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('css/simplebar.css'); ?>">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
    <!-- Feather CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('css/feather.css'); ?>">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('css/daterangepicker.css'); ?>">

    <!-- App CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('css/app-light.css'); ?>"
          id="lightTheme">
    <link rel="stylesheet"
          href="<?php echo base_url('css/app-dark.css'); ?>"
          id="darkTheme" disabled>

</head>
<body class="light ">

<?php

$this->load->view($view);

?>


<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/moment.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/simplebar.min.js"></script>
<script src='../js/daterangepicker.js'></script>
<script src='../js/jquery.stickOnScroll.js'></script>
<script src="../js/tinycolor-min.js"></script>
<script src="../js/config.js"></script>
<script src="../js/apps.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async
        src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }

  gtag('js', new Date());
  gtag('config', 'UA-56159088-1');
</script>
</body>
</html>
</body>
</html>
