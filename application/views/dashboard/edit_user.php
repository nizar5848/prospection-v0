<style>
.alert-card {
    position: absolute; /* Changed to absolute positioning */
    top: -18px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000; /* Ensure it's above other elements */
    width: 500px;
    opacity: 0;
    animation: swingInOut 10s forwards;
    transform-origin: top center;
    border-radius: 20px;
    padding: 15px; /* Added padding to prevent content from touching edges */
}

@keyframes swingInOut {
    0%, 100% {
        opacity: 0;
        transform: translateX(-50%) scale(0.9);
    }
    10%, 90% {
        opacity: 1;
        transform: translateX(-50%) scale(1);
    }
}

.alert-card .close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 24px;
    color: #000;
    cursor: pointer;
}

.alert-card .close:hover {
    color: #dc3545;
}

.card {
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    width: 100%;
    max-width: 600px;
    margin-bottom: 150px;
    border: 1px solid #e0e0e0;
    overflow: hidden; /* Ensure border-radius affects all corners */
    position: relative; /* Ensure card is the container for absolute positioning */
    margin-top: 90px; /* Move the card up by 10px */
}


.card-body {
    position: relative;
    z-index: 1; /* Ensure content is on top of the background */
}

.card h3 {
    text-align: center;
    margin-bottom: 10px;
    font-family: 'Arial', sans-serif;
    font-size: 24px;
    color: #343a40;
}

.card hr {
    margin: 20px 0;
    border: none;
    border-top: 1px solid #e0e0e0;
}

.form-group label {
    font-weight: bold;
    font-size: 14px;
    color: #495057;
}

.form-control {
    border-radius: 10px;
    border: 1px solid #ced4da;
}

.form-control:focus {
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    border-color: #007bff;
}

.btn-primary {
    border-radius: 10px;
    width: 100%;
    padding: 10px;
    font-size: 16px;
    background-color: #007bff;
    border-color: #007bff;
    margin-top: 20px; /* Space above the button */
    margin-bottom: -15px; /* Reduced space below the button */
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.invalid-feedback {
    display: none;
}

.was-validated .form-control:invalid ~ .invalid-feedback {
    display: block;
}

.password-requirements {
    background-color: #f8f9fa;
    padding: 15px;
    border: 1px solid #ced4da;
    margin-top: 10px;
    border-radius: 10px;
}

.password-requirements ul {
    padding-left: 20px;
}

.password-requirements li {
    font-size: 14px;
}

.text-muted {
    font-size: 12px;
}

.navbar-brand-img {
    height: 60px;
}
</style>
<?php if (validation_errors()): ?>
    <div class="alert alert-danger alert-card">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<div class="wrapper vh-98">


<div class="row align-items-center h-100">
    <div class="card col-lg-6 col-md-8 col-10 mx-auto needs-validation" style="border: 1px solid #e0e0e0; border-radius: 20px;">
        <?php echo form_open('DashboardController/edit_user/'.$user['id'], [
            'class' => 'needs-validation', 'novalidate' => true,
        ]); ?>

        <div class="card-body">
            <div class="mx-auto text-center flex">
                <h3><i class="fas fa-user-edit"></i></h3>
                <h3 class="my-2">Modifier Utilisateur</h3>
                <hr>
            </div>

            <div class="form-group">
                <label for="inputEmail4">E-mail</label>
                <input type="email" class="form-control" name="email" id="inputEmail4"
                       value="<?php echo set_value('email', $user['email']); ?>" required>
                <div class="invalid-feedback text-left">Please use a valid email.</div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="first_name" class="form-control"
                           value="<?php echo set_value('first_name', $user['first_name']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Nom</label>
                    <input type="text" id="lastname" name="last_name" class="form-control"
                           value="<?php echo set_value('last_name', $user['last_name']); ?>" required>
                </div>
            </div>

            <hr class="my-3">

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputPassword5">Nouveau mot de passe</label>
                        <input type="password" name="password" class="form-control" id="inputPassword5">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword6">Confirmez le mot de passe</label>
                        <input type="password" class="form-control" name="confirm_password" id="inputPassword6">
                    </div>
                </div>
                <div class="col-md-6 password-requirements">
                    <p class="mb-2">Exigences du mot de passe</p>
                    <p class="small text-muted mb-2">Pour créer un nouveau mot de passe, vous devez remplir toutes les
                        conditions suivantes :</p>
                    <ul class="small text-muted pl-4 mb-0">
                        <li>Minimum 8 caractères</li>
                        <li>Au moins un caractère spécial</li>
                        <li>Au moins un chiffre</li>
                    </ul>
                </div>
            </div>

            <?php if ($currentUserId == 1): ?>
    <div class="form-group">
        <label for="role">Rôle</label>
        <div>
            <label class="radio-inline mr-5">
                <input type="radio" name="role" value="admin" <?php echo $user['role'] == 'admin' ? 'checked' : ''; ?>> Admin
            </label>
            <label class="radio-inline">
                <input type="radio" name="role" value="user" <?php echo $user['role'] == 'user' ? 'checked' : ''; ?>> Gestionnaire
            </label>
        </div>
    </div>
<?php endif; ?>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Modifier</button>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.alert-card .close').forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.style.display = 'none';
        });
    });
});
</script>
