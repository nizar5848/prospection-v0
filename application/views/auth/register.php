<style>
        .alert-card {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            width: 500px;
            opacity: 0;
            animation: swingInOut 4s forwards;
            transform-origin: top center;
        }

        @keyframes swingInOut {
            0% { opacity: 0; transform: translate(-50%, -50%) rotateX(-90deg); }
            10% { opacity: 1; transform: translate(-50%, -50%) rotateX(0deg); }
            90% { opacity: 1; transform: translate(-50%, -50%) rotateX(0deg); }
            100% { opacity: 0; transform: translate(-50%, -50%) rotateX(-90deg); }
        }
    </style>
<div class="wrapper vh-98 p-5 mt-5">
    <?php if ($this->session->flashdata('error')): ?>
        <div id="errorAlert" class="alert alert-danger alert-dismissible fade show alert-card" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
    <div class="row align-items-center h-100">
        <?php echo form_open('AuthController/register', [
            'class' => 'col-lg-6 col-md-8 col-10 mx-auto needs-validation',
            'novalidate' => true,
        ]); ?>

        <div class="mx-auto text-center mt-5 flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="../index.html">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-md"
                     xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 120 120" xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87"/>
                        <polygon class="st0" points="96,69 33,69 42,51 105,51"/>
                        <polygon class="st0" points="78,33 15,33 24,15 87,15"/>
                    </g>
                </svg>
            </a>
            <h2 class="my-3"><?php echo $is_admin_exists ? 'Inscrire un utilisateur' : 'Inscription'; ?></h2>
        </div>

        <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show alert-card">', '</div>'); ?>

        <div class="form-group">
            <label for="inputEmail4">E-mail</label>
            <input type="email" class="form-control" name="email"
                   id="inputEmail4" value="<?php echo set_value('email'); ?>" required>
            <div class="invalid-feedback text-left">
                <?php echo form_error('email'); ?>
                Veuillez utiliser un email valide
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="first_name"
                       class="form-control" value="<?php echo set_value('first_name'); ?>" required>
                <div class="invalid-feedback text-left">
                    <?php echo form_error('first_name'); ?>
                    Veuillez utiliser un prénom valide
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="last_name"
                       class="form-control" value="<?php echo set_value('last_name'); ?>" required>
                <div class="invalid-feedback text-left">
                    <?php echo form_error('last_name'); ?>
                    Veuillez utiliser un nom valide
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputPassword5">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control"
                           id="inputPassword5" required>
                    <div class="invalid-feedback text-left">
                        <?php echo form_error('password'); ?>
                        Veuillez utiliser un mot de passe valide
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword6">Confirmez le mot de passe</label>
                    <input type="password" class="form-control"
                           name="confirm_password" id="inputPassword6" required>
                    <div class="invalid-feedback text-left">
                        <?php echo form_error('confirm_password'); ?>
                        Veuillez confirmer le mot de passe
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <p class="mb-2">Exigences du mot de passe</p>
                <p class="small text-muted mb-2">Pour créer un nouveau mot de passe, vous devez remplir toutes les conditions suivantes :</p>
                <ul class="small text-muted pl-4 mb-0">
                    <li>Minimum 8 caractères</li>
                    <li>Au moins un caractère spécial</li>
                    <li>Au moins un chiffre</li>
                </ul>
            </div>
        </div>

        <?php if ($is_admin_exists): ?>
            <div class="form-group">
                <label for="role">Rôle</label>
                <div>
                    <label class="radio-inline mr-5">
                        <input type="radio" name="role" value="admin"> Admin
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="role" value="user" checked> Utilisateur
                    </label>
                </div>
                <div class="invalid-feedback text-left">
                    <?php echo form_error('role'); ?>
                </div>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary btn-lg btn-block mt-5">Enregistrer</button>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    // Bootstrap validation styles
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Alert dismissal
    setTimeout(function() {
        const alertElement = document.getElementById('errorAlert');
        if (alertElement) {
            alertElement.style.opacity = '0';
            alertElement.style.transition = 'opacity 0.5s ease-out';
        }
    }, 3000);
</script>
