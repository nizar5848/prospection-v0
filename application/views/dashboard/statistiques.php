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

<div class="container mt-4">
    <h2 class="mb-4">Statistiques</h2>
    <div class="row">
        <!-- Events Timeline Chart -->
        <div class="col-md-6 mb-4">
            <div class="card bg-white pb-4">
                <div class="card-header">
                    Nombre d'Événements
                </div>
                <div class="card-body chart-container">
                    <canvas id="eventsTimelineChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Prospects by Status Chart -->
        <div class="col-md-6 mb-4">
            <div class="card bg-white pb-4">
                <div class="card-header">
                    Répartition des Prospects par Statut
                    <span>(Total : <?php echo isset($total_prospects) ? $total_prospects : 0; ?> prospects)</span>
                </div>
                <div class="card-body chart-container">
                    <canvas id="prospectsByStatusChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Prospects Created Over Time Chart -->
        <div class="col-md-6 mb-4">
            <div class="card bg-white pb-4">
                <div class="card-header">
                    Prospects Créés au Fil du Temps
                </div>
                <div class="card-body chart-container">
                    <canvas id="prospectsOverTimeChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Conversion Percentage Chart -->
        <div class="col-md-6 mb-4">
            <div class="card bg-white pb-4">
                <div class="card-header">
                    Pourcentage de Conversion <span
                            class="font-weight-bold"> <?php echo number_format($conversion_percentage, 2); ?>%</span>
                </div>
                <div class="card-body chart-container">
                    <canvas id="conversionPercentageChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Events Timeline Chart
    var ctx1 = document.getElementById('eventsTimelineChart').getContext('2d');
    var eventsTimelineChart = new Chart(ctx1, {
      type: 'line',
      data: {
        labels: [
            <?php if (isset($events_data)) {
            foreach ($events_data as $event) {
                echo '"'.date('Y-m', mktime(0, 0, 0, $event['month'], 1)).'",';
            }
        } ?>
        ],
        datasets: [
          {
            label: 'Nombre d\'Événements',
            data: [
                <?php if (isset($events_data)) {
                foreach ($events_data as $event) {
                    echo $event['event_count'].',';
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
              text: 'Nombre d\'Événements',
            },
          },
          x: {
            title: {
              display: true,
              text: 'Mois',
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

    // Prospects Created Over Time Chart
    var ctx3 = document.getElementById('prospectsOverTimeChart').getContext('2d');
    var prospectsOverTimeChart = new Chart(ctx3, {
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

    // Conversion Percentage Chart
    var ctx4 = document.getElementById('conversionPercentageChart').getContext('2d');
    var conversionPercentageChart = new Chart(ctx4, {
      type: 'doughnut',
      data: {
        labels: ['Converti', 'Non Converti'],
        datasets: [
          {
            label: 'Pourcentage de Conversion',
            data: [
                <?php echo isset($conversion_percentage) ? $conversion_percentage : 0; ?>,
                <?php echo 100 - (isset($conversion_percentage) ? $conversion_percentage : 0); ?>
            ],
            backgroundColor: [
              'rgba(75, 192, 192, 0.2)',
              'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
              'rgba(75, 192, 192, 1)',
              'rgba(255, 99, 132, 1)',
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
                  label += ': ' + tooltipItem.raw.toFixed(2) + '%';
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
