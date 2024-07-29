<div class="container">
<button type="button" class="btn btn-outline-danger ms-2 mb-3" onclick="window.location.href='<?= site_url('ProspectController/close_call/'.$prospect->id) ?>'"><i class="fas fa-phone-slash me-1"></i> Clôturer l'appel
</button>
    <div class="row">
        <!-- Main Prospect Details Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0 text-white">Détails du Prospect</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <i class="fas fa-user-circle fa-3x text-success"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0"><?= $prospect->first_name ?> <?= $prospect->last_name ?></h5>
                            <small class="text-muted"><?= $prospect->company ?></small>
                        </div>
                    </div>
                    <div class="list-group">
                        <div class="list-group-item bg-light">
                            <i class="fas fa-envelope text-success me-2 mr-1"></i>
                            <strong>E-mail:</strong> <?= $prospect->email ?>
                        </div>
                        <div class="list-group-item bg-light">
                            <i class="fas fa-building text-success me-2 mr-1"></i>
                            <strong>Entreprise:</strong> <?= $prospect->company ?>
                        </div>
                        <div class="list-group-item bg-light">
                            <i class="fas fa-phone text-success me-2 mr-1"></i>
                            <strong>Numéro téléphone:</strong> <?= $prospect->phone_number ?>
                        </div>
                        <div class="list-group-item bg-light">
                            <i class="fas fa-map-marker-alt text-success me-2 mr-1"></i>
                            <strong>Adresse:</strong> <?= $prospect->address ?>
                        </div>
                        <div class="list-group-item bg-light">
                            <i class="fas fa-info-circle text-success me-2 mr-1"></i>
                            <strong>Status:</strong> <?= $prospect->status ?>
                        </div>
                        <div class="list-group-item bg-light">
                            <i class="fas fa-calendar-alt text-success me-2 mr-1"></i>
                            <strong>Date de Création:</strong> <?= date('d-m-Y', strtotime($prospect->created_at)) ?>
                        </div>
                        <div class="list-group-item bg-light">
                            <i class="fas fa-calendar-check text-success me-2 mr-1"></i>
                            <strong>Dernière Mise à Jour:</strong> <?= date('d-m-Y', strtotime($prospect->updated_at)) ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="<?= site_url('ProspectController/edit_prospect/'.$prospect->id) ?>" class="btn btn-outline-primary me-2"><i class="fas fa-edit me-1"></i>Modifier</a>
                    <a href="<?= site_url('ProspectController/delete_prospect/'.$prospect->id) ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt me-1"></i>Supprimer</a>
                </div>
            </div>
        </div>

        <!-- Historique Interactions Card -->
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
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

        <!-- Change Status and Notes Cards in the Same Row -->
        <div class="col-md-12 mb-4">
            <div class="row">
                <!-- Change Status Card -->
                <!-- Change Status Card -->
<div class="col-md-4 mb-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0 text-white">Changer le Statut</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('ProspectController/change_status/'.$prospect->id) ?>" method="post">
                <div class="form-group mb-3">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status">
                    <option value="nouveau" <?= ($prospect->status == 'nouveau') ? 'selected' : '' ?>>Nouveau</option>
                        <option value="contacte" <?= ($prospect->status == 'contacte') ? 'selected' : '' ?>>Contacté</option>
                        <option value="en_negociation" <?= ($prospect->status == 'en_negociation') ? 'selected' : '' ?>>En Négociation</option>
                        <option value="converti" <?= ($prospect->status == 'converti') ? 'selected' : '' ?>>Converti</option>
                        <option value="perdu" <?= ($prospect->status == 'perdu') ? 'selected' : '' ?>>Perdu</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-sync-alt me-1"></i> Mettre à Jour</button>
            </form>
        </div>
    </div>
</div>

                <!-- Notes Card -->
                <div class="col-md-8 mb-4">
                    <div class="card shadow-sm border-0 ">
                        <div class="card-header bg-secondary text-white">
                            <h4 class="mb-0 text-white">Prendre des Notes</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('ProspectController/add_note/'.$prospect->id) ?>" method="post">
                                <div class="form-group mb-2">
                                    <textarea class="form-control" name="note" rows="4" placeholder="Écrivez vos notes ici..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save me-1"></i> Sauvegarder</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
