<style>
    .alert-card {
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        width: 500px;
        opacity: 0;
        animation: swingInOut 8s forwards;
        transform-origin: top center;
        margin-left: 129px;
        border-radius: 20px;
    }

    @keyframes swingInOut {
        0% {
            opacity: 0;
            transform: translateX(-50%) rotateX(-90deg);
        }
        10% {
            opacity: 1;
            transform: translateX(-50%) rotateX(0deg);
        }
        90% {
            opacity: 1;
            transform: translateX(-50%) rotateX(0deg);
        }
        100% {
            opacity: 0;
            transform: translateX(-50%) rotateX(-90deg);
        }
    }

    .centered-container {
        height: 860px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
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
        position: relative; /* For positioning the before pseudo-element */
        margin-top: 130px;
    }

    .card::before {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 20px;
        pointer-events: none;
    }

    .card h3 {
        text-align: center;
        margin-bottom: 30px;
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
        margin-top: 20px;
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


</style>

<div class="centered-container vh-98">
    <div class="card">
        <div class="mx-auto text-center">

            <h3 class="my-3"><i
                        class="fas fa-user-plus"></i><?php echo $is_admin_exists ? ' '.'Créer Utilisateur' : 'Inscription'; ?>
            </h3>
        </div>
        <hr class="my-3">
        <?php echo form_open('DashboardController/register', [
            'class' => 'needs-validation', 'novalidate' => true,
        ]); ?>
        <div class="form-group">
            <label for="inputEmail4">E-mail</label>
            <input type="email" class="form-control" name="email" id="inputEmail4"
                   value="<?php echo set_value('email'); ?>" required>
            <div class="invalid-feedback text-left">Veuilez saisir un e-mail valide.</div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="first_name" class="form-control"
                       value="<?php echo set_value('first_name'); ?>" required>
                <div class="invalid-feedback text-left">Veuilez saisir votre prénom.</div>
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="last_name" class="form-control"
                       value="<?php echo set_value('last_name'); ?>" required>
                <div class="invalid-feedback text-left">Veuilez saisir votre nom.</div>
            </div>
        </div>
        <hr class="my-3">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputPassword5">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control" id="inputPassword5" required>
                    <div class="invalid-feedback text-left">Veuillez entrer mot de passe avec les exigences
                        recommendés.
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword6">Confirmez le mot de passe</label>
                    <input type="password" class="form-control" name="confirm_password" id="inputPassword6" required>
                    <div class="invalid-feedback text-left">Veuilez confirmer votre password.</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="password-requirements">
                    <p class="mb-2">Exigences du mot de passe</p>
                    <p class="small text-muted mb-2">Pour créer un nouveau mot de passe, vous devez remplir toutes les
                        conditions suivantes :</p>
                    <ul class="small text-muted mb-0">
                        <li>Minimum 8 caractères</li>
                        <li>Au moins un caractère spécial</li>
                        <li>Au moins un chiffre</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if ($is_admin_exists): ?>
            <div class="form-group">
                <label for="role">Rôle</label>
                <div>
                    <label class="radio-inline mr-5"><input type="radio" name="role" value="admin"> Admin</label>
                    <label class="radio-inline"><input type="radio" name="role" value="user" checked>
                        Gestionnaire</label>
                </div>
            </div>
        <?php endif; ?>
        <button class="btn btn-lg btn-primary btn-block"
                type="submit"><?php echo $is_admin_exists ? 'Créer utilisateur' : 'S\'inscrire'; ?></button>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if ($this->session->flashdata('error')): ?>
    <div id="errorAlert" class="alert alert-danger alert-dismissible fade show alert-card" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
    <div id="successAlert" class="alert alert-success alert-dismissible fade show alert-card" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (isset($validation_errors) && ! empty($validation_errors)): ?>
    <div class="alert alert-danger alert-dismissible fade show alert-card" role="alert">
        <?php echo $validation_errors; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<script>
  // Bootstrap validation styles
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      var forms = document.getElementsByClassName('needs-validation');
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
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
    const alertElements = document.querySelectorAll('.alert-card');
    alertElements.forEach(alertElement => {
      alertElement.style.opacity = '0';
      alertElement.style.transition = 'opacity 0.5s ease-out';
    });
  }, 7000); // 7000 milliseconds = 7 seconds
</script>
