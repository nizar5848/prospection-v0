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
        </style>

    <?php endif; ?>


    <style>


        @media (min-width: 1200px) {
            .container, .container-sm, .container-md, .container-lg, .container-xl {
                max-width: 1400px;
            }
        }

        /* prospects table experimental styles */
        /* Basic table styling */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin: 20px 0;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 250px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            padding: 5px 10px;
        }

        /* Table header styling */
        table.dataTable thead th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
            border-bottom: 2px solid #dee2e6;
        }

        /* Table body styling */
        table.dataTable tbody tr {
            background-color: #fff;
        }

        table.dataTable tbody tr:hover {
            background-color: #f1f3f5;
        }

        table.dataTable tbody tr.odd {
            background-color: #f9f9f9;
        }

        /* Row highlighting */
        table.dataTable tbody tr.selected {
            background-color: #d4edda;
            color: #155724;
        }

        /* Cell padding */
        table.dataTable td, table.dataTable th {
            padding: 12px 15px;
        }

        /* Borders and spacing */
        table.dataTable {
            border-collapse: collapse;
            width: 100%;
        }

        table.dataTable, table.dataTable th, table.dataTable td {
            border: 1px solid #dee2e6;
        }

        /* Pagination button styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 5px 10px;
            margin-left: 5px;
            cursor: pointer;
            color: #333;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #007bff;
            border: 1px solid #007bff;
            color: #fff;
        }

        /* Info and length styling */
        .dataTables_wrapper .dataTables_info {
            color: #333;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 4px;
            border: 1px solid #ced4da;
            padding: 5px;
        }

        /* Responsive table styling */
        @media screen and (max-width: 768px) {
            table.dataTable {
                width: 100%;
                border: 0;
            }

            table.dataTable tbody td {
                display: block;
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table.dataTable tbody td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 10px;
                font-weight: bold;
                text-align: left;
                background-color: #f8f9fa;
                border-right: 1px solid #dee2e6;
            }

            table.dataTable tbody td:first-child {
                border-top: 1px solid #dee2e6;
            }

            table.dataTable tbody td:last-child {
                border-bottom: 1px solid #dee2e6;
            }
        }
    </style>
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
        <?php
        // Get the current URL segment
        $current_url = uri_string();
        if ($this->session->userdata('role') === 'admin') {
            $sidebar_active_color = 'blue';
        } else {
            $sidebar_active_color = '#32CD32';
        }
        ?>

        <nav class="vertnav navbar navbar-light">
            <!-- nav bar -->
            <div class="w-100 mb-4 d-flex">
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="<?= base_url('dashboard') ?>">
                    <?php if ($this->session->userdata('role') == 'user'): ?>
                        <svg version="1.1" id="logo" class="navbar-brand-img brand-sm"
                             xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 120 120"
                             xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87"/>
                        <polygon class="st0" points="96,69 33,69 42,51 105,51"/>
                        <polygon class="st0" points="78,33 15,33 24,15 87,15"/>
                    </g>
                </svg>
                    <?php elseif ($this->session->userdata('role') == 'admin'): ?>
                        <svg version="1.1" id="logo" class="navbar-brand-img brand-sm"
                             xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 120 120"
                             xml:space="preserve">
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
                       href="<?= base_url('dashboard') ?>"
                       style="color: <?= ($current_url === 'dashboard') ? $sidebar_active_color : 'inherit'; ?>;
                               background: <?= ($current_url === 'dashboard') ? 'whitesmoke' : 'inherit'; ?>;">
                        <i class="fe fe-home fe-16"></i>
                        <span class="ml-3 item-text">Dashboard</span>
                    </a>
                </li>

                <?php if ($this->session->userdata('role') == 'admin'): ?>
                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Gestion des commerciaux</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item w-100">
                        <a class="nav-link"
                           href="<?= base_url('register_user') ?>"
                           style="color: <?= ($current_url === 'register_user') ? $sidebar_active_color : 'inherit'; ?>;
                                   background: <?= ($current_url === 'register_user') ? 'whitesmoke' : 'inherit'; ?>;">
                            <i class="fe fe-user-plus fe-16"></i>
                            <span class="ml-3 item-text">Créer commercial</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link"
                           href="<?= base_url('table-utilisateurs') ?>"
                           style="color: <?= ($current_url === 'table-utilisateurs') ? $sidebar_active_color : 'inherit'; ?>;
                                   background: <?= ($current_url === 'table-utilisateurs') ? 'whitesmoke' : 'inherit'; ?>;">
                            <i class="fe fe-list"></i>
                            <span class="ml-3 item-text">Liste des commerciaux</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <p class="text-muted nav-heading mt-4 mb-1">
                        <span>Gestion des prospections</span>
                    </p>
                    <ul class="navbar-nav flex-fill w-100 mb-2">

                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?= base_url('register-prospect') ?>"
                               style="color: <?= ($current_url === 'register-prospect') ? $sidebar_active_color : 'inherit'; ?>;
                                       background: <?= ($current_url === 'register-prospect') ? 'whitesmoke' : 'inherit'; ?>;">
                                <i class="fe fe-user-plus fe-16"></i>
                                <span class="ml-3 item-text">Créer prospect</span>
                            </a>
                        </li>

                        <li class="nav-item w-100">
                            <?php if ($this->session->userdata('role') === 'admin'): ?>
                                <a class="nav-link"
                                   href="<?php echo base_url('table-prospects-globale'); ?>"
                                   style="color: <?= ($current_url === 'table-prospects-globale') ? $sidebar_active_color : 'inherit'; ?>;
                                           background: <?= ($current_url === 'table-prospects-globale') ? 'whitesmoke' : 'inherit'; ?>;">
                                    <i class="fe fe-list"></i>
                                    <span class="ml-3 item-text">Liste globale prospects</span>
                                </a>
                            <?php else: ?>
                                <a class="nav-link"
                                   href="<?php echo base_url('table-prospects'); ?>"
                                   style="color: <?= ($current_url === 'table-prospects') ? $sidebar_active_color : 'inherit'; ?>;
                                           background: <?= ($current_url === 'table-prospects') ? 'whitesmoke' : 'inherit'; ?>;">
                                    <i class="fe fe-list"></i>
                                    <span class="ml-3 item-text">Tous les prospects</span>
                                </a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?= base_url('prospects-contacter') ?>"
                               style="color: <?= ($current_url === 'prospects-contacter') ? $sidebar_active_color : 'inherit'; ?>;
                                       background: <?= ($current_url === 'prospects-contacter') ? 'whitesmoke' : 'inherit'; ?>;">
                                <i class="fe fe-phone-outgoing fe-16"></i>
                                <span class="ml-3 item-text">Prospects à contacter</span>
                            </a>
                        </li>
                        <p class="text-muted nav-heading mt-4 mb-1">
                            <span>Tables des prospects par rôle </span>
                        </p>
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?php echo base_url('table-prospects-nouveau'); ?>"
                               style="color: <?= ($current_url === 'table-prospects-nouveau') ? $sidebar_active_color : 'inherit'; ?>;
                                       background: <?= ($current_url === 'table-prospects-nouveau') ? 'whitesmoke' : 'inherit'; ?>;">
                                <i class="fe fe-user-plus"></i>
                                <span class="ml-3 item-text">Nouveaux prospects</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?php echo base_url('table-prospects-contacte'); ?>"
                               style="color: <?= ($current_url === 'table-prospects-contacte') ? $sidebar_active_color : 'inherit'; ?>;
                                       background: <?= ($current_url === 'table-prospects-contacte') ? 'whitesmoke' : 'inherit'; ?>;">
                                <i class="fe fe-phone"></i>
                                <span class="ml-3 item-text">Prospects contactés</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?php echo base_url('table-prospects-en_negociation'); ?>"
                               style="color: <?= ($current_url === 'table-prospects-en_negociation') ? $sidebar_active_color : 'inherit'; ?>;
                                       background: <?= ($current_url === 'table-prospects-en_negociation') ? 'whitesmoke' : 'inherit'; ?>;">
                                <i class="fe fe-shuffle"></i>
                                <span class="ml-3 item-text">Prospects en négociation</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?php echo base_url('table-prospects-converti'); ?>"
                               style="color: <?= ($current_url === 'table-prospects-converti') ? $sidebar_active_color : 'inherit'; ?>;
                                       background: <?= ($current_url === 'table-prospects-converti') ? 'whitesmoke' : 'inherit'; ?>;">
                                <i class="fe fe-check"></i>
                                <span class="ml-3 item-text">Prospects convertis</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?php echo base_url('table-prospects-perdu'); ?>"
                               style="color: <?= ($current_url === 'table-prospects-perdu') ? $sidebar_active_color : 'inherit'; ?>;
                                       background: <?= ($current_url === 'table-prospects-perdu') ? 'whitesmoke' : 'inherit'; ?>;">
                                <i class="fe fe-x"></i>
                                <span class="ml-3 item-text">Prospects perdus</span>
                            </a>
                        </li>


                    </ul>

                    <p class="text-muted nav-heading mt-4 mb-1">
                        <span>Statistiques</span>
                    </p>
                    <ul class="navbar-nav flex-fill w-100 mb-2">
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?= base_url('statistiques') ?>"
                               style="color: <?= ($current_url === 'statistiques') ? $sidebar_active_color : 'inherit'; ?>;
                                       background: <?= ($current_url === 'statistiques') ? 'whitesmoke' : 'inherit'; ?>;">
                                <i class="fe fe-pie-chart fe-16"></i>
                                <span class="ml-3 item-text">Statistiques</span>
                            </a>
                        </li>
                    </ul>

                    <p class="text-muted nav-heading mt-4 mb-1">
                        <span>Rappels</span>
                    </p>
                    <ul class="navbar-nav flex-fill w-100 mb-2">
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?= base_url('rappels') ?>"
                               style="color: <?= ($current_url === 'rappels') ? $sidebar_active_color : 'inherit'; ?>;
                                       background: <?= ($current_url === 'rappels') ? 'whitesmoke' : 'inherit'; ?>;">
                                <i class="fe fe-bell fe-16"></i>
                                <span class="ml-3 item-text">Rappels</span>
                                <?php if (isset($pending_count) && $pending_count > 0): ?>
                                    <span class="badge <?= $this->session->userdata('role') === 'admin' ? 'badge-primary' : 'badge-success' ?> font-weight-bolder px-2 text-white pt-2"><?= $pending_count ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link"
                               href="<?= base_url('/calendrier') ?>"
                               style="color: <?= ($current_url === 'calendrier') ? $sidebar_active_color : 'inherit'; ?>;
                                       background: <?= ($current_url === 'calendrier') ? 'whitesmoke' : 'inherit'; ?>;">
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
