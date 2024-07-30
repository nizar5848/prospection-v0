<main role="main" class="main-content mx-auto">
    <div class="container-fluid">
        <h1 class="mb-5">Bienvenue, <?= $firstname." ".$lastname ?></h1>
        <div class="header-body">
            <div class="row">
                <!-- Total Prospects Card -->
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card card-stats shadow bg-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total des Prospects</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo number_format($total_prospects); ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow"
                                         style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-users" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Total Events Card -->
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card card-stats shadow bg-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total des Événements</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo number_format($total_events); ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow"
                                         style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-calendar-alt" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Reminders Card -->
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card card-stats shadow bg-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Mes Rappels</h5>

                                    <span class="h2 font-weight-bold mb-0"><?php echo number_format($pending_count); ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow"
                                         style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-bell" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Conversion Rate Card -->
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card card-stats shadow bg-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Taux de Conversion</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo number_format($conversion_percentage,
                                            2); ?>%</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning-light text-white rounded-circle shadow"
                                         style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-percent" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Active Prospects Card -->
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card card-stats shadow bg-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Prospects à Contacter</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo number_format($active_prospects); ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow"
                                         style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-phone" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Prospects Card -->
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card card-stats shadow bg-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Nouveaux Prospects</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo number_format($new_prospects); ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow"
                                         style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user-plus" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->

            <div class="row mt-4">
                <!-- Prospects Created Over Time Chart -->
                <div class="col-md-6 mb-4">
                    <div class="card bg-white pb-5">
                        <div class="card-header">
                            Prospects Créés au Fil du Temps
                        </div>
                        <div class="card-body chart-container p-5">
                            <canvas id="prospectsOverTimeChart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Prospects by Status Chart -->
                <div class="col-md-6 mb-4">
                    <div class="card bg-white pb-5">
                        <div class="card-header">
                            Répartition des Prospects par Statut
                            <span>(Total : <?php echo isset($total_prospects) ? $total_prospects : 0; ?> prospects)</span>
                        </div>
                        <div class="card-body chart-container p-5">
                            <canvas id="prospectsByStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .chart-container {
        position: relative;
        height: 300px; /* Adjust this height to match your needs */
    }

    .chart-container canvas {
        position: absolute;
        top: 0;
        left: 0;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Prospects Created Over Time Chart
    var ctx1 = document.getElementById('prospectsOverTimeChart').getContext('2d');
    var prospectsOverTimeChart = new Chart(ctx1, {
      type: 'line',
      data: {
        labels: [
            <?php if (isset($prospects_data)) {
            foreach ($prospects_data as $prospect) {
                echo '"'.date('Y-m-d', strtotime($prospect['day'])).'",';
            }
        } ?>
        ],
        datasets: [
          {
            label: 'Nombre de Prospects',
            data: [
                <?php if (isset($prospects_data)) {
                foreach ($prospects_data as $prospect) {
                    echo $prospect['prospect_count'].',';
                }
            } ?>
            ],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
          }],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Nombre de Prospects',
            },
          },
          x: {
            title: {
              display: true,
              text: 'Jours',
            },
          },
        },
      },
    });

    // Prospects by Status Chart
    var ctx2 = document.getElementById('prospectsByStatusChart').getContext('2d');
    var prospectsByStatusChart = new Chart(ctx2, {
      type: 'pie',
      data: {
        labels: [
            <?php if (isset($prospects_status_data)) {
            foreach ($prospects_status_data as $item) {
                $status = htmlspecialchars($item['status']);
                switch ($status) {
                    case 'nouveau':
                        $status = 'Nouveau';
                        break;
                    case 'contacte':
                        $status = 'Contacté';
                        break;
                    case 'en_negociation':
                        $status = 'En Négociation';
                        break;
                    case 'converti':
                        $status = 'Converti';
                        break;
                    case 'perdu':
                        $status = 'Perdu';
                        break;
                }
                echo '"'.$status.'",';
            }
        } ?>
        ],
        datasets: [
          {
            label: 'Nombre de Prospects',
            data: [
                <?php if (isset($prospects_status_data)) {
                foreach ($prospects_status_data as $item) {
                    echo $item['count'].',';
                }
            } ?>
            ],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1,
          }],
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          tooltip: {
            callbacks: {
              label: function(tooltipItem) {
                var label = tooltipItem.label || '';
                if (label) {
                  label += ': ' + tooltipItem.raw + ' prospects';
                }
                return label;
              },
            },
          },
        },
      },
    });
  });
</script>
