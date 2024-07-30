<div class="container">
    <h3 class="mb-3">Créer un rappel</h3>

    <?= form_open('rappels/create', ['class' => 'form-horizontal']) ?>

    <div class="form-group">
        <?= form_label('Titre', 'title', ['class' => 'control-label']) ?>
        <?= form_input('title', set_value('title'), ['class' => 'form-control', 'id' => 'title']) ?>
        <?= form_error('title', '<div class="text-danger">', '</div>') ?>
    </div>

    <div class="form-group">
        <?= form_label('Description', 'description', ['class' => 'control-label']) ?>
        <?= form_textarea('description', set_value('description'),
            ['class' => 'form-control', 'id' => 'description']) ?>
        <?= form_error('description', '<div class="text-danger">', '</div>') ?>
    </div>

    <div class="form-group">
        <?= form_submit('submit', 'Créer le rappel', ['class' => 'btn btn-primary']) ?>
    </div>

    <?= form_close() ?>
</div>
