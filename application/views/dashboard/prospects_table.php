<div class="container">
    <?php if ($this->session->userdata('role') === 'admin'): ?>
        <h2>Table de tous les prospects</h2>
    <?php else: ?>
        <h2>Table de mes prospects</h2>
    <?php endif; ?>

    <br><br>
    <table id="example1" class="table border dt-responsive nowrap"
           style="width:100%">
        <thead>
        <tr>
            <th class="text-dark">Identifiant</th>
            <th class="text-dark">Nom</th>
            <th class="text-dark">Prénom</th>
            <th class="text-dark">E-mail</th>
            <th class="text-dark">Entreprise</th>
            <th class="text-dark">Tel</th>
            <th class="text-dark">Adresse</th>
            <th class="text-dark">Status</th>
            <?php if ($this->session->userdata('role') === 'user'): ?>
                <th class="text-dark">Actions</th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Import jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
      {data: 'status'}
    ];

    <?php if ($this->session->userdata('role') === 'user'): ?>
        columns.push({data: 'actions', orderable: false, searchable: false});
    <?php endif; ?>

    $('#example1').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/French.json',
      },
      ajax: {
        url: "<?php echo base_url('DashboardController/fetchProspects'); ?>",
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
  });
</script>
