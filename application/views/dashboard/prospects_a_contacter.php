<style>

.alert {
    position: fixed;
    top: 10px;
    left: 55%;
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

/* Optional: Custom styles for alert dismissal button */
.alert .btn-close {
    background: transparent;
    border: none;
    color: #155724;
}


    .custom-close-btn {
        background-color: transparent;
        border: none;
        font-size: 1.5rem;
        color: #454545;
        cursor: pointer;
        outline: none;
    }

    .custom-close-btn:hover {
        color: #ff1a1a;
    }

    .avatar {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
    }

    .initials {
        color: #fff;
        font-size: 20px;
        font-weight: bold;
    }

    .card-header {
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
    }

    .card-body p {
        margin-bottom: 0.5rem;
    }

    .card-body i {
        margin-right: 0.5rem;
        color: #007bff;
    }

    .card {
        border: 1px solid #ccc;
    }

    .close {
        background-color: transparent;
        border: none;
        font-size: 1.25rem;
    }
</style>
<?php if ($this->session->flashdata('call_ended')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('call_ended'); ?>
        </div>
    <?php endif; ?>
<div class="container my-5">
    <h3 class="mb-4">Prospects à contacter</h3>

    <div class="row">
        <?php if (!empty($active_prospects)): ?>
            <?php foreach ($active_prospects as $prospect): ?>
                <?php if (is_array($prospect)): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm rounded-lg border">
                            <div class="card-header bg-white d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-success rounded-circle mr-3">
                                        <span class="initials"><?php echo strtoupper(substr($prospect['first_name'], 0, 1)).strtoupper(substr($prospect['last_name'], 0, 1)); ?></span>
                                    </div>
                                    <h5 class="card-title mb-0"><?php echo $prospect['first_name'].' '.$prospect['last_name']; ?></h5>
                                </div>

                                <button type="button" class="custom-close-btn ms-2 mb-3"
                                        onclick="window.location.href='<?= site_url('ProspectController/close_call/'.$prospect['id']) ?>'">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><i class="fas fa-envelope"></i> <?php echo $prospect['email']; ?></p>
                                <p class="card-text"><i class="fas fa-building"></i> <?php echo $prospect['company']; ?></p>
                                <p class="card-text"><i class="fas fa-phone"></i> <?php echo $prospect['phone_number']; ?></p>
                                <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?php echo $prospect['address']; ?></p>
                                <p class="card-text"><i class="fas fa-info-circle"></i> <?php echo ucfirst($prospect['status']); ?></p>
                                <a href="<?php echo base_url('ProspectController/consult_prospect/'.$prospect['id'].'?source=contact'); ?>"
                                   class="btn btn-outline-primary btn-block">Contacter prospect</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No active prospects found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Custom CSS -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var alert = document.querySelector('.alert');
    if (alert) {
        alert.style.display = 'block';
        setTimeout(function() {
            alert.style.opacity = 0;
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500); // Adjust fade-out duration
        }, 3000); // Adjust time before fade-out
    }
});

</script>