<div class="wrapper vh-100">
    <div class="row align-items-center h-100">
        <!--        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center">-->
        <?php echo form_open('AuthController/login',
            ['class' => 'col-lg-3 col-md-4 col-10 mx-auto text-center']); ?>
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center"
           href="../index.html">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-md"
                 xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 120 120" xml:space="preserve">
              <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	"/>
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	"/>
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	"/>
              </g>
            </svg>
        </a>
        <h1 class="h6 mb-3">Connexion</h1>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">e-mail</label>
            <input type="email" id="inputEmail"
                   name="email"
                   class="form-control form-control-lg"
                   placeholder="e-mail" required="" autofocus="">
        </div>
        <div class="form-group">
            <label for="inputPassword" class="sr-only">Mot de passe</label>
            <input type="password" id="inputPassword"
                   name="password"
                   class="form-control form-control-lg"
                   placeholder="Mot de passe" required="">
        </div>
        <?php
        $is_logged_in = true; // This could be based on your actual login logic
        ?>

        <?php if ( ! $is_admin_exists): ?>
            <div class="checkbox mb-3">
                <a href="<?php echo base_url('register'); ?>">
                    créer admin
                </a>
            </div>
        <?php endif; ?>


        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
        <p class="mt-5 mb-3 text-muted">© 2024</p>
        <!--        </form>-->
        <?php echo form_close(); ?>
    </div>
</div>
