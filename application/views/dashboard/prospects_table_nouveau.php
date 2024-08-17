<style>
    .alert {
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1050; /* Ensure it appears on top */
        width: 20%; /* Adjust width as needed */
        display: none; /* Initially hidden */
        padding: 10px;
        border-radius: 5px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert-warning {
        background-color: #fff3cd;
        color: #856404;
    }
</style>
<div class="container mt-4">
    <!-- Alerts positioned at the top center -->
    <?php if ($this->session->flashdata('success')): ?>
        <div id="alert-success" class="alert alert-success" role="alert">
            <?= htmlspecialchars($this->session->flashdata('success')) ?>
        </div>
    <?php elseif ($this->session->flashdata('error')): ?>
        <div id="alert-error" class="alert alert-error" role="alert">
            <?= htmlspecialchars($this->session->flashdata('error')) ?>
        </div>
    <?php elseif ($this->session->flashdata('warning')): ?>
        <div id="alert-warning" class="alert alert-warning" role="alert">
            <?= htmlspecialchars($this->session->flashdata('warning')) ?>
        </div>
    <?php endif; ?>

    <!-- Your view content here -->
    <h3 class="mb-4">Table des prospects nouveaux</h3>

    <div class="row">
        <!-- Left card: Selection fields (shown only if role is user) -->
        <?php if ($this->session->userdata('role') == 'user'): ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="<?php echo base_url('ProspectController/selectProspects'); ?>">
                            <div class="form-group">
                                <label for="number_of_prospects">Nombre de prospects:</label>
                                <select id="number_of_prospects" name="number_of_prospects" class="form-control">
                                    <option value="" default>Selectionner un nombre</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Statut:</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="" default>Selectionner un statut</option>
                                    <option value="nouveau">Nouveau</option>
                                    <option value="contacte">Contacté</option>
                                    <option value="en_negociation">En négociation</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-1">Sélectionner</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Right card: Import and Export buttons -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Import form (only shown for non-admins) -->
                    <?php if ($this->session->userdata('role') !== 'admin'): ?>
                        <form method="post" enctype="multipart/form-data"
                              action="<?php echo base_url('ProspectController/importFromExcel'); ?>" class="mb-3">
                            <label class="mt-1" for="excel_file">Importer depuis Excel:</label>
                            <div class="d-flex align-items-center mt-3">
                                <div class="form-group mb-2 mr-2">
                                    <input type="file" name="excel_file" class="form-control-file" accept=".xls,.xlsx"/>
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Importer</button>
                            </div>
                        </form>
                    <?php endif; ?>

                    <!-- Export form (always shown) -->
                    <form method="post" action="<?php echo base_url('ProspectController/exportToExcel'); ?>">
                        <div class="d-flex flex-column align-items-start">
                            <label for="number_of_prospects" class="mb-2 mt-2">Exporter la table vers Excel:</label>
                            <button type="submit" class="btn btn-success mt-4">Exporter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white mt-5 px-5 border">
        <table id="example1" class="table border dt-responsive nowrap mt-3" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Entreprise</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Statut</th>
                <?php if ($this->session->userdata('role') === 'user'): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Import jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Import Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Import DataTables JS -->
<script src="https://cdn.datatables.net/2.0.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<script>
  $(document).ready(function() {
    var columns = [
      {data: 'id'},
      {data: 'last_name'},
      {data: 'first_name'},
      {data: 'email'},
      {data: 'company'},
      {data: 'phone_number'},
      {data: 'address'},
      {data: 'status'},
    ];

      <?php if ($this->session->userdata('role') === 'user'): ?>
    columns.push({data: 'actions', orderable: false, searchable: false});
      <?php endif; ?>

    $('#example1').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/French.json',
      },
      ajax: {
        url: "<?php echo base_url('DashboardController/fetchProspects/nouveau'); ?>",
        data: function(d) {
          d.status = 'nouveau'; // Filter for 'nouveau' status
        },
        dataSrc: function(json) {
          console.log('data shows here:');
          console.log(json);
          return json.data;
        },
      },
      columns: columns,
      order: [],
      responsive: true,
    });

    // Show success, error, and warning alerts and hide after 3 seconds
      <?php if ($this->session->flashdata('success')): ?>
    $('#alert-success').fadeIn().delay(3000).fadeOut();
      <?php elseif ($this->session->flashdata('error')): ?>
    $('#alert-error').fadeIn().delay(3000).fadeOut();
      <?php elseif ($this->session->flashdata('warning')): ?>
    $('#alert-warning').fadeIn().delay(3000).fadeOut();
      <?php endif; ?>
  });
</script>
