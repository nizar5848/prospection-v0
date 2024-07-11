<div class="wrapper vh-100">
    <div class="row align-items-center h-100">
        <?php echo form_open('AuthController/register', ['class' => 'col-lg-6 col-md-8 col-10 mx-auto']); ?>
        
        <div class="mx-auto text-center my-4">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="../index.html">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	"/>
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	"/>
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	"/>
                    </g>
                </svg>
            </a>
            <h2 class="my-3"><?php echo $is_admin_exists ? 'Register User' : 'Inscription'; ?></h2>
        </div>
        
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        
        <div class="form-group">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" name="email" id="inputEmail4" required>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="first_name" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Nom de famille</label>
                <input type="text" id="lastname" name="last_name" class="form-control" required>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputPassword5">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control" id="inputPassword5" required>
                </div>
                <div class="form-group">
                    <label for="inputPassword6">Confirmez le mot de passe</label>
                    <input type="password" class="form-control" name="confirm_password" id="inputPassword6" required>
                </div>
            </div>
            <div class="col-md-6">
                <p class="mb-2">Exigences du mot de passe</p>
                <p class="small text-muted mb-2">Pour créer un nouveau mot de passe, vous devez remplir toutes les conditions suivantes :</p>
                <ul class="small text-muted pl-4 mb-0">
                    <li>Minimum 8 caractères</li>
                    <li>Au moins un caractère spécial</li>
                    <li>Au moins un chiffre</li>
                    <li>Ne peut pas être le même qu'un mot de passe précédent</li>
                </ul>
            </div>
        </div>
        
        <?php if ($is_admin_exists): ?>
            <div class="form-group">
                <label for="role">Rôle</label>
                <div>
                    <label class="radio-inline mr-5"><input type="radio" name="role" value="admin"> Admin</label>
                    <label class="radio-inline"><input type="radio" name="role" value="user" checked> Gestionnaire</label>
                </div>
            </div>
        <?php endif; ?>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $is_admin_exists ? 'Sign up' : 'S\'inscrire'; ?></button>
        <p class="mt-5 mb-3 text-muted text-center">© 2020</p>
        
        <?php echo form_close(); ?>
    </div>
</div>
