<div class="container">
    <table id="example1" class="table border dt-responsive nowrap"
           style="width:100%">
        <thead>
        <tr>
            <th class="text-info">Identifiant</th>
            <th class="text-info">Nom</th>
            <th class="text-info">Prénom</th>
            <th class="text-info">E-mail</th>
            <th class="text-info">Rôle</th>
            <th class="text-info">Actions</th>
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
<!--<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.min.js"></script>-->
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<!--<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>-->

<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/French.json',
      },
      ajax: {
        url: "<?php echo base_url('AdminController/fetchDatafromDatabase'); ?>",
        dataSrc: function(json) {
          console.log('data shows here:');
          console.log(json);
          return json.data;
        },
      },
      columns: [
        {data: 'id'},
        {data: 'last_name'},
        {data: 'first_name'},
        {data: 'email'},
        {data: 'role'},
        {data: 'actions', orderable: false, searchable: false},
      ],
      order: [],
      responsive: true,
    });
  });
</script>
