<div class="rendezvous-container"
     style="background-color: #f8f9fa; border-radius: 8px; margin: 10px 0; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
    <div id="rendezvousBanner" class="d-flex justify-content-between align-items-center p-3"
         style="cursor: pointer; background-color: #007bff; border-radius: 8px;">
        <h4 class="alert-heading mb-0 text-white" style="font-size: 1.6rem; font-weight: 600;">
            Rendez-vous du jour (<?php echo count($rendezvous); ?>)
        </h4>
        <i id="toggleIcon" class="fas fa-chevron-down text-white" style="font-size: 1.6rem;"></i>
    </div>
    <ul id="rendezvousList" class="list-group mt-3"
        style="display: none; background-color: #ffffff; padding: 15px; border-radius: 8px;">
        <?php foreach ($rendezvous as $r): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center"
                style="margin-bottom: 8px; font-size: 1.2rem; padding: 12px 15px; border: 1px solid #e9ecef; border-radius: 5px;">
                <div>
                    <strong><?php echo htmlspecialchars($r['event_name']); ?></strong>
                </div>
                <div style="color: #6c757d;">
                    De : <?php echo date('H:i', strtotime($r['event_start_datetime'])); ?>
                    à <?php echo date('H:i', strtotime($r['event_end_datetime'])); ?>
                </div>
            </li>
        <?php endforeach; ?>
        <?php if (empty($rendezvous)): ?>
            <p style="font-size: 1.2rem; padding-top: 10px; text-align: center; color: #6c757d;">Aucun rendez-vous prévu
                pour aujourd'hui.</p>
        <?php endif; ?>
    </ul>

</div>

<script>
  // Sort the rendezvous list items by start time
  document.addEventListener('DOMContentLoaded', function() {
    const list = document.getElementById('rendezvousList');
    const items = Array.from(list.children);

    items.sort((a, b) => {
      const timeA = a.getAttribute('data-start-time');
      const timeB = b.getAttribute('data-start-time');
      return timeA.localeCompare(timeB);
    });

    items.forEach(item => list.appendChild(item));
  });

  // Toggle the rendezvous list on banner click
  document.getElementById('rendezvousBanner').addEventListener('click', function() {
    const list = document.getElementById('rendezvousList');
    const icon = document.getElementById('toggleIcon');

    if (list.style.display === 'none') {
      list.style.display = 'block';
      icon.classList.remove('fa-chevron-down');
      icon.classList.add('fa-chevron-up');
    } else {
      list.style.display = 'none';
      icon.classList.remove('fa-chevron-up');
      icon.classList.add('fa-chevron-down');
    }
  });
</script>
