<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Main Prospect Details Card -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0 text-white">Détails du Prospect</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <i class="fas fa-user-circle fa-3x text-success mr-3"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0"><?= $prospect->first_name ?> <?= $prospect->last_name ?></h5>
                            <small class="text-muted"><?= $prospect->company ?></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="bg-light p-3 rounded">
                                <i class="fas fa-envelope text-success me-2 mr-2"></i>
                                <strong>E-mail:</strong> <?= $prospect->email ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="bg-light p-3 rounded">
                                <i class="fas fa-building text-success me-2 mr-2"></i>
                                <strong>Entreprise:</strong> <?= $prospect->company ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="bg-light p-3 rounded">
                                <i class="fas fa-phone text-success me-2 mr-2"></i>
                                <strong>Numéro téléphone:</strong> <?= $prospect->phone_number ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="bg-light p-3 rounded">
                                <i class="fas fa-map-marker-alt text-success me-2 mr-2"></i>
                                <strong>Adresse:</strong> <?= $prospect->address ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="bg-light p-3 rounded">
                                <i class="fas fa-info-circle text-success me-2 mr-2"></i>
                                <strong>Status:</strong> <?= $prospect->status ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="bg-light p-3 rounded">
                                <i class="fas fa-calendar-alt text-success me-2 mr-2"></i>
                                <strong>Date de Création:</strong> <?= date('d-m-Y', strtotime($prospect->created_at)) ?>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="bg-light p-3 rounded">
                                <i class="fas fa-calendar-check text-success me-2 mr-2"></i>
                                <strong>Dernière Mise à Jour:</strong> <?= date('d-m-Y', strtotime($prospect->updated_at)) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="<?= site_url('ProspectController/edit_prospect/'.$prospect->id) ?>" class="btn btn-outline-primary me-2"><i class="fas fa-edit me-1"></i>Modifier</a>
                    <a href="<?= site_url('ProspectContro/delete_prospect/'.$prospect->id) ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt me-1"></i>Supprimer</a>
                </div>
            </div>
        </div>
        <!-- Historique Interactions Card -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0 text-white">Historique Interactions</h4>
                </div>
                <div class="card-body">
                    <div class="bg-light p-3 rounded">
                        <i class="fas fa-history text-info me-2"></i>
                        <strong>Historique:</strong> <?= nl2br($prospect->historiqueInteractions) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
