<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
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
<div class="wrapper vh-100">
    <div class="row align-items-center h-100">
        <!--        <form class="col-lg-6 col-md-8 col-10 mx-auto">-->

        <?php echo form_open('authController/register_admin',
            ['class' => 'col-lg-6 col-md-8 col-10 mx-auto']); ?>

        <div class="mx-auto text-center my-4">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center"
               href="../index.html">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-md"
                     xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 120 120" xml:space="preserve">
                    <g>
                        <polygon class="st0"
                                 points="78,105 15,105 24,87 87,87 	"/>
                        <polygon class="st0"
                                 points="96,69 33,69 42,51 105,51 	"/>
                        <polygon class="st0"
                                 points="78,33 15,33 24,15 87,15 	"/>
                    </g>
                </svg>
            </a>
            <h2 class="my-3">Inscription</h2>
        </div>
        <?php echo validation_errors('<div class="alert alert-danger">',
            '</div>'); ?>
        <div class="form-group">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" name="email"
                   id="inputEmail4">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="first_name"
                       class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Nom de famille</label>
                <input type="text" id="lastname" name="last_name"
                       class="form-control">
            </div>
        </div>
        <hr class="my-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputPassword5">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control"
                           id="inputPassword5">
                </div>
                <div class="form-group">
                    <label for="inputPassword6">Confirmez le mot de
                        passe</label>
                    <input type="password" class="form-control"
                           name="confirm_password" id="inputPassword6">
                </div>
            </div>
            <div class="col-md-6">
                <p class="mb-2">Exigences du mot de passe</p>
                <p class="small text-muted mb-2">Pour créer un nouveau mot de
                    passe, vous devez remplir toutes les conditions suivantes
                    :</p>
                <ul class="small text-muted pl-4 mb-0">
                    <li>Minimum 8 caractères</li>
                    <li>Au moins un caractère spécial</li>
                    <li>Au moins un chiffre</li>
                    <li>Ne peut pas être le même qu'un mot de passe précédent
                    </li>
                </ul>
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            S'inscrire
        </button>
        <p class="mt-5 mb-3 text-muted text-center">© 2020</p>
        <?php echo form_close(); ?>
    </div>
</div>
<script src="../../../js/jquery.min.js"></script>
<script src="../../../js/popper.min.js"></script>
<script src="../../../js/moment.min.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/simplebar.min.js"></script>
<script src='../../../js/daterangepicker.js'></script>
<script src='../../../js/jquery.stickOnScroll.js'></script>
<script src="../../../js/tinycolor-min.js"></script>
<script src="../../../js/config.js"></script>
<script src="../../../js/apps.js"></script>
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
