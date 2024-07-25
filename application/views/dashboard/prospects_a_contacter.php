<div class="container my-5">
    <h2 class="mb-4 text-center">Active Prospects</h2>
    <div class="row">
        <?php if (!empty($active_prospects)): ?>
            <?php foreach ($active_prospects as $prospect): ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm rounded-lg border">
                        <div class="card-header bg-white text-white d-flex align-items-center">
                            <div class="avatar bg-success rounded-circle mr-3">
                                <span class="initials"><?php echo strtoupper(substr($prospect['first_name'], 0, 1)) . strtoupper(substr($prospect['last_name'], 0, 1)); ?></span>
                            </div>
                            <h5 class="card-title mb-0"><?php echo $prospect['first_name'] . ' ' . $prospect['last_name']; ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><i class="fas fa-envelope"></i> <?php echo $prospect['email']; ?></p>
                            <p class="card-text"><i class="fas fa-building"></i> <?php echo $prospect['company']; ?></p>
                            <p class="card-text"><i class="fas fa-phone"></i> <?php echo $prospect['phone_number']; ?></p>
                            <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?php echo $prospect['address']; ?></p>
                            <p class="card-text"><i class="fas fa-info-circle"></i> <?php echo ucfirst($prospect['status']); ?></p>
                            <a href="<?php echo base_url('ProspectController/consult_prospect/' . $prospect['id']); ?>" class="btn btn-outline-primary btn-block">Contacter prospect</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No active prospects found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Custom CSS -->
<style>
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
</style>
