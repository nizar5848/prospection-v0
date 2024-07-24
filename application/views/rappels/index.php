<div class="container">
    <h1>Index des rappels</h1>

    <a href="<?= site_url('rappels/create') ?>" class="btn btn-primary mb-4">Créer un nouveau rappel</a>

    <div class="row">
        <?php foreach ($rappels as $rappel): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $rappel['title'] ?></h5>
                        <p class="card-text"><?= $rappel['description'] ?></p>
                        <p class="card-text">
                            <strong>Status:</strong> <?= $rappel['status'] == 'pending' ? 'En attente' : 'Fait' ?>
                        </p>
                        <p class="card-text">
                            <small class="text-muted">Créé le: <?= $rappel['created_at'] ?></small>
                        </p>
                        <a href="<?= site_url('rappels/switch_status/'.$rappel['id']) ?>"
                           class="btn btn-<?= $rappel['status'] == 'pending' ? 'success' : 'warning' ?>">
                            <?= $rappel['status'] == 'pending' ? 'Marquer comme fait' : 'Marquer comme en attente' ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
