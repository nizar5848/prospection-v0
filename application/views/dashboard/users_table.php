<div class="container">
    <table id="example1"
           class="table table-striped table-bordered dt-responsive nowrap"
           style="width:100%">
        <thead>
        <tr>
            <th class="text-dark">Identifiant</th>
            <th class="text-dark">Nom</th>
            <th class="text-dark">Prénom</th>
            <th class="text-dark">E-mail</th>
            <th class="text-dark">Rôle</th>
            <th class="text-dark">Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    $('#example1').DataTable({
      'ajax': {
        'url': "<?php echo base_url('AdminController/fetchDatafromDatabase'); ?>",
        'dataSrc': function(json) {
          console.log('data shows here:');
          console.log(json);
          return json.data;
        },
      },
      'columns': [
        {'data': 'id'},
        {'data': 'last_name'},
        {'data': 'first_name'},
        {'data': 'email'},
        {'data': 'role'},
        {'data': 'actions', 'orderable': false, 'searchable': false},
      ],
      'order': [],
    });
  });
</script>
