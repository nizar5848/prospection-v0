<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon"
          href="<?= $this->session->userdata('role') === 'admin' ? base_url('assets/ico/logo-blue.ico') : base_url('assets/ico/logo-green.ico') ?>">

    <title>NA | <?= $title; ?></title>

    <!-- CSS pour le calendrier complet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"
          rel="stylesheet"/>
    <!-- JS pour jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Bootstrap CSS et JS -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="<?php echo base_url('css/simplebar.css'); ?>">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="<?php echo base_url('css/feather.css'); ?>">
    <!-- FullCalendar CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('css/fullcalendar.css'); ?>">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?php echo base_url('css/select2.css'); ?>">
    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="<?php echo base_url('css/dropzone.css'); ?>">
    <!-- Uppy CSS -->
    <link rel="stylesheet" href="<?php echo base_url('css/uppy.min.css'); ?>">
    <!-- jQuery Steps CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('css/jquery.steps.css'); ?>">
    <!-- jQuery Timepicker CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('css/jquery.timepicker.css'); ?>">
    <!-- Quill Snow CSS -->
    <link rel="stylesheet" href="<?php echo base_url('css/quill.snow.css'); ?>">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url('css/daterangepicker.css'); ?>">
    <!-- DataTables CSS -->
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="<?php echo base_url('css/app-light.css'); ?>"
          id="lightTheme">
    <link rel="stylesheet" href="<?php echo base_url('css/app-dark.css'); ?>"
          id="darkTheme" disabled>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .st0 {
            fill: #32CD32; /* Change fill color to green */
        }

        .st1 {
            fill: blue; /* Fill color for admin */
        }
    </style>

    <?php if ($this->session->userdata('role') === 'user'): ?>
        <style>
            /* Define the green class styles */
            .green {
                background: #32CD32;

                color: white;
            }

            .green:hover {
                background: #2db92d;
            }

            /* Apply the green class on hover */
            .nav-item:hover .nav-link .fe,
            .nav-item:hover .nav-link .item-text {
                color: #32CD32;
            }

            @media (min-width: 1200px) {
                .container, .container-sm, .container-md, .container-lg, .container-xl {
                    max-width: 1400px;
                }
            }
        </style>

    <?php endif; ?>


</head>
<body class="vertical light">
<div class="wrapper">
    <nav class="topnav navbar navbar-light">
        <button type="button"
                class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
            <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <ul class="nav">
            <!--            <li class="nav-item">-->
            <!--                <a class="nav-link text-muted my-2" href="#" id="modeSwitcher"-->
            <!--                   data-mode="light">-->
            <!--                    <i class="fe fe-sun fe-16"></i>-->
            <!--                </a>-->
            <!--            </li>-->

            <!--dropdown avatar-->
            <li class="nav-item dropdown" style="position: relative; right: 35px;">
                <a class="nav-link text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
                   onclick="toggleDropdown()" aria-haspopup="true" aria-expanded="false"
                   style="display: flex; align-items: center; height: fit-content; cursor: pointer;">
              <span class="avatar avatar-sm mt-2"
                    style="display: flex; justify-content: center; align-items: center; background-color: <?= $this->session->userdata('role') === 'admin' ? 'blue' : '#32CD32' ?>; border-radius: 50%; width: 35px; height: 35px;">
                    <span style="color: white; font-size: 14px; margin-top: 4px; font-weight: bold;">
                <?php
                $first_name = $this->session->userdata('first_name');
                $last_name  = $this->session->userdata('last_name');
                $initials   = strtoupper($first_name[0].$last_name[0]);
                echo $initials;
                ?>
            </span>
        </span>
                </a>
                <div class="dropdown-menu" id="dropdownMenu"
                     style="display: none; position: absolute; top: 100%; left: -100px; background-color: white; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15); border-radius: 4px; z-index: 1000; min-width: 160px;">
                    <a class="dropdown-item" href="<?= base_url('DashboardController/profile') ?>"
                       style="display: block; padding: 8px 16px; color: black; text-decoration: none;">Profile</a>
                    <a class="dropdown-item" href="<?= base_url('authController/logout') ?>"
                       style="display: block; padding: 8px 16px; color: black; text-decoration: none;">Déconnexion</a>
                </div>

            </li>


            <!--end of dropdown avatar-->
        </ul>
    </nav>
    <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar"
           data-simplebar>
        <a href="#"
           class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3"
           data-toggle="toggle">
            <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
            <!-- nav bar -->
            <div class="w-100 mb-4 d-flex">
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center"
                   href="<?= base_url('dashboard') ?>">
                    <?php if ($this->session->userdata('role') == 'user'): ?>
                        <svg version="1.1" id="logo"
                             class="navbar-brand-img brand-sm"
                             xmlns="http://www.w3.org/2000/svg"
                             x="0px"
                             y="0px" viewBox="0 0 120 120" xml:space="preserve">
        <g>
            <polygon class="st0" points="78,105 15,105 24,87 87,87"/>
            <polygon class="st0" points="96,69 33,69 42,51 105,51"/>
            <polygon class="st0" points="78,33 15,33 24,15 87,15"/>
        </g>
    </svg>
                    <?php elseif ($this->session->userdata('role') == 'admin'): ?>
                        <svg version="1.1" id="logo"
                             class="navbar-brand-img brand-sm"
                             xmlns="http://www.w3.org/2000/svg"
                             x="0px"
                             y="0px" viewBox="0 0 120 120" xml:space="preserve">
        <g>
            <polygon class="st1" points="78,105 15,105 24,87 87,87"/>
            <polygon class="st1" points="96,69 33,69 42,51 105,51"/>
            <polygon class="st1" points="78,33 15,33 24,15 87,15"/>
        </g>
    </svg>
                    <?php endif; ?>

                </a>
            </div>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link"
                       href="<?= base_url('dashboard') ?>">
                        <i class="fe fe-home fe-16"></i>
                        <span class="ml-3 item-text">Dashboard</span>
                    </a>
                </li>


            </ul>
            <?php if ($this->session->userdata('role') == 'admin'): ?>
            <p class="text-muted nav-heading mt-4 mb-1">
                <span>Gestion des utilisateurs</span>
            </p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="<?= base_url('register_user') ?>">
                        <i class="fe fe-user-plus fe-16"></i>
                        <span class="ml-3 item-text">Créer utilisateur</span>
                    </a>
                </li>
                <li class="nav-item w-100">
                    <a class="nav-link" href="<?= base_url('table-utilisateurs') ?>">
                        <i class="fe fe-list"></i>
                        <span class="ml-3 item-text">Liste des utilisateurs</span>
                    </a>
                </li>
                <?php endif; ?>
                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Gestion des prospections</span>
                </p>

                <ul class="navbar-nav flex-fill w-100 mb-2">

                    <?php if ($this->session->userdata('role') == 'user'): ?>
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?= base_url('register-prospect') ?>">
                                <i class="fe fe-user-plus fe-16"></i>
                                <span class="ml-3 item-text">Créer prospect</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item w-100">
                        <?php $role = $this->session->userdata('role'); ?>
                        <?php if (isset($role) && $role === 'admin'): ?>
                            <a class="nav-link" href="<?php echo base_url('table-prospects-globale'); ?>">
                                <i class="fe fe-list"></i>
                                <span class="ml-3 item-text">Liste de tout les prospects</span>
                            </a>
                        <?php endif; ?>

                        <a class="nav-link" href="<?php echo base_url('table-prospects-nouveau'); ?>">
                            <i class="fe fe-user-plus"></i>
                            <span class="ml-3 item-text">Prospects Nouveau</span>
                        </a>
                        <a class="nav-link" href="<?php echo base_url('table-prospects-contacte'); ?>">
                            <i class="fe fe-phone"></i>
                            <span class="ml-3 item-text">Prospects Contacté</span>
                        </a>
                        <a class="nav-link" href="<?php echo base_url('table-prospects-en_negociation'); ?>">
                            <i class="fe fe-shuffle"></i>
                            <span class="ml-3 item-text">Prospects en Négociation</span>
                        </a>
                        <a class="nav-link" href="<?php echo base_url('table-prospects-converti'); ?>">
                            <i class="fe fe-check"></i>
                            <span class="ml-3 item-text">Prospects Converti</span>
                        </a>
                        <a class="nav-link" href="<?php echo base_url('table-prospects-perdu'); ?>">
                            <i class="fe fe-x"></i>
                            <span class="ml-3 item-text">Prospects Perdu</span>
                        </a>
                    </li>


                    <?php if ($this->session->userdata('role') == 'user'): ?>
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?= base_url('prospects-contacter') ?>">
                                <i class="fe fe-phone fe-16"></i>
                                <span class="ml-3 item-text">Prospects à contacter</span>
                            </a>
                        </li>
                    <?php endif; ?>


                </ul>
                <p class="text-muted nav-heading mt-4 mb-1">
                    <!--                    <span>Rapports et statistiques</span>-->
                    <span>statistiques</span>
                </p>
                <?php
                if ($this->session->userdata('role')) ?>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <!--                    <li class="nav-item w-100">-->
                    <!--                        <a class="nav-link" href="#">-->
                    <!--                            <i class="fe fe-paperclip fe-16"></i>-->
                    <!--                            <span class="ml-3 item-text">Rapports</span>-->
                    <!--                        </a>-->
                    <!--                    </li>-->
                    <li class="nav-item w-100">
                        <a class="nav-link" href="<?= base_url('statistiques') ?>">
                            <i class="fe fe-pie-chart fe-16"></i>
                            <span class="ml-3 item-text">Statistiques</span>
                        </a>
                    </li>
                </ul>


                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Rappels</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <!-- Example navigation item with badge -->
                    <li class="nav-item w-100">
                        <a class="nav-link" href="<?= base_url('rappels') ?>">
                            <i class="fe fe-bell fe-16"></i>
                            <span class="ml-3 item-text">Rappels</span>
                            <!-- Badge for number of pending rappels -->
                            <?php if (isset($pending_count) && $pending_count > 0): ?>
                                <span class="badge <?= $this->session->userdata('role') === 'admin' ? 'badge-primary' : 'badge-success' ?> font-weight-bolder px-2 text-white pt-2"><?= $pending_count ?></span>
                            <?php endif; ?>
                        </a>
                    </li>


                    <li class="nav-item w-100">
                        <a class="nav-link"
                           href="<?= base_url('/calendrier') ?>">
                            <i class="fe fe-calendar fe-16"></i>
                            <span class="ml-3 item-text">Calendrier</span>
                        </a>
                    </li>
                </ul>
        </nav>
    </aside>
    <main role="main" class="main-content" style="margin-top: -30px">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">

                    <?php
                    $this->load->view($view);
                    ?>

                    <!-- Here we can add some content -->


    </main> <!-- main -->
</div> <!-- .wrapper -->
<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('js/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('js/simplebar.min.js'); ?>"></script>
<script src="<?php echo base_url('js/daterangepicker.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.stickOnScroll.js'); ?>"></script>
<script src="<?php echo base_url('js/tinycolor-min.js'); ?>"></script>
<script src="<?php echo base_url('js/config.js'); ?>"></script>
<script src="<?php echo base_url('js/d3.min.js'); ?>"></script>
<script src="<?php echo base_url('js/topojson.min.js'); ?>"></script>
<script src="<?php echo base_url('js/datamaps.all.min.js'); ?>"></script>
<script src="<?php echo base_url('js/datamaps-zoomto.js'); ?>"></script>
<script src="<?php echo base_url('js/datamaps.custom.js'); ?>"></script>
<script src="<?php echo base_url('js/Chart.min.js'); ?>"></script>
<script>
  /* define global options */
  Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
  Chart.defaults.global.defaultFontColor = colors.mutedColor;
</script>
<script src="<?php echo base_url('js/gauge.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.sparkline.min.js'); ?>"></script>
<script src="<?php echo base_url('js/apexcharts.min.js'); ?>"></script>
<script src="<?php echo base_url('js/apexcharts.custom.js'); ?>"></script>
<script src="<?php echo base_url('js/apps.js'); ?>"></script>

<!--    imports for data table-->

<script type="text/javascript"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
<!--dropdown avatar script-->
<script>
  function toggleDropdown() {
    var dropdownMenu = document.getElementById('dropdownMenu');
    if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
      dropdownMenu.style.display = 'block';
    } else {
      dropdownMenu.style.display = 'none';
    }
  }

  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.closest('#navbarDropdownMenuLink')) {
      var dropdowns = document.getElementsByClassName('dropdown-menu');
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.style.display === 'block') {
          openDropdown.style.display = 'none';
        }
      }
    }
  };
</script>
</body>
</html>
