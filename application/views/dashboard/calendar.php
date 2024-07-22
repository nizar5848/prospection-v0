<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="d-flex justify-content-between align-items-end mb-3">
                <a href="<?php echo base_url('dashboard'); ?>"
                   class="hover-arrow link-underline-primary">
                    <i class="fe fe-arrow-left"></i> Retour
                </a>
                <h5 class="text-center mx-auto">Calendrier</h5>
            </div>


            <div id="calendar"></div>
        </div>
    </div>

</div>
<!-- Début de la boîte de dialogue contextuelle -->
<div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog"
     aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Ajouter un nouvel
                    événement</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="event_name">Nom de
                                    l'événement</label>
                                <input type="text" name="event_name"
                                       id="event_name" class="form-control"
                                       placeholder="Entrez le nom de votre événement">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="event_start_date">Début de
                                    l'événement</label>
                                <input type="date" name="event_start_date"
                                       id="event_start_date"
                                       class="form-control onlydatepicker"
                                       placeholder="Date de début de l'événement">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="event_end_date">Fin de
                                    l'événement</label>
                                <input type="date" name="event_end_date"
                                       id="event_end_date" class="form-control"
                                       placeholder="Date de fin de l'événement">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                        onclick="save_event()">Enregistrer l'événement
                </button>
            </div>
        </div>
    </div>
</div>


<!--<script src="js/jquery.min.js"></script>-->
<!--<script src="js/popper.min.js"></script>-->
<!--<script src="js/moment.min.js"></script>-->
<!--<script src="js/bootstrap.min.js"></script>-->
<!--<script src="js/simplebar.min.js"></script>-->
<!--<script src='js/daterangepicker.js'></script>-->
<!--<script src='js/jquery.stickOnScroll.js'></script>-->
<!--<script src="js/tinycolor-min.js"></script>-->
<!--<script src="js/config.js"></script>-->
<!--<script src='js/fullcalendar.js'></script>-->
<!--<script src='js/fullcalendar.custom.js'></script>-->

<!--JS pour le calendrier complet-->-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/fr.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>-->
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js'></script>

<script>
  function display_events() {
    var events = []; // Initialize an empty array for events

    $.ajax({
      url: '<?php echo base_url('calendar/display_event'); ?>',
      dataType: 'json',
      success: function(response) {
        var result = response.data;
        console.log(result);

        // Populate events array with data from AJAX response
        $.each(result, function(i, item) {
          events.push({
            event_id: item.event_id,
            title: item.title,
            start: item.start,
            end: item.end,
            color: item.color,
            url: item.url,
          });
        });

        // Initialize FullCalendar after data is loaded
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          locale: 'fr',
          initialView: 'dayGridMonth',
          timeZone: 'local',
          editable: true,
          selectable: true,
          select: function(info) {
            $('#event_start_date').val(info.startStr);
            $('#event_end_date').val(info.endStr);
            $('#event_entry_modal').modal('show');
          },
          events: events, // Pass events array to FullCalendar
          eventClick: function(info) {
            alert('Event ID: ' + info.event.id);
          },
        });

        calendar.render(); // Render the calendar
      },
      error: function(xhr, status, error) {
        alert('Erreur: ' + xhr.statusText);
      },
    });
  }

  function save_event() {
    var event_name = $('#event_name').val();
    var event_start_date = $('#event_start_date').val();
    var event_end_date = $('#event_end_date').val();
    if (event_name == '' || event_start_date == '' || event_end_date == '') {
      alert('Veuillez entrer tous les détails requis.');
      return false;
    }
    $.ajax({
      url: "<?php echo base_url('calendar/save_event'); ?>",
      type: 'POST',
      dataType: 'json',
      data: {
        event_name: event_name,
        event_start_date: event_start_date,
        event_end_date: event_end_date,
      },
      success: function(response) {
        $('#event_entry_modal').modal('hide');
        if (response.status == true) {
          alert(response.msg);
          location.reload();
        } else {
          alert(response.msg);
        }
      },
      error: function(xhr, status, error) {
        console.log('Erreur AJAX = ' + xhr.statusText);
        alert('Erreur: ' + xhr.statusText);
      },
    });
    return false;
  }

  $(document).ready(function() {
    display_events();
  }); //end document.ready block
</script>
