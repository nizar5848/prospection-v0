<div class="wrapper vh-100">
    <div class="row align-items-center h-100">
        <?php echo form_open('AuthController/login', [
            'class' => 'col-lg-3 col-md-4 col-10 mx-auto text-center needs-validation',
            'novalidate' => true
        ]); ?>
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="../index.html">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                    <polygon class="st0" points="78,105 15,105 24,87 87,87 	"/>
                    <polygon class="st0" points="96,69 33,69 42,51 105,51 	"/>
                    <polygon class="st0" points="78,33 15,33 24,15 87,15 	"/>
                </g>
            </svg>
        </a>
        <h1 class="h6 mb-3">Connexion</h1>
        <form class="needs-validation" novalidate>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">e-mail</label>
                <input type="email" id="inputEmail" name="email" class="form-control form-control-lg" placeholder="e-mail" value="<?php echo set_value('email'); ?>" required autofocus="">
                <div class="invalid-feedback  text-left"> Please use a valid email </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Mot de passe</label>
                <input type="password" id="inputPassword" name="password" class="form-control form-control-lg" placeholder="Mot de passe" required="">
                <div class="invalid-feedback text-left"> utiliser mdp correct </div>
            </div>
            <?php if (!$is_admin_exists): ?>
                <div class="checkbox mb-3">
                    <a href="<?php echo base_url('register'); ?>">Créer admin</a>
                </div>
            <?php endif; ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
            <p class="mt-5 mb-3 text-muted">© 2024</p>
            <?php echo form_close(); ?>
    </div>

    <script>
      // Example Functions to Trigger Toasts
      function showToast(type, title, message) {
        $('#toast-container').append(`
                <div class="custom-toast ${type} show">
                    <div class="icon-container">
                        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="..." />
                        </svg>
                    </div>
                    <div class="content-container">
                        <div class="title">${title}</div>
                        <div class="message">${message}</div>
                    </div>
                    <button onclick="this.parentElement.remove()">×</button>
                </div>
            `);
      }

      // Check for flashdata from PHP
      <?php if ($error_message): ?>
      showToast('error', 'Erreur', '<?php echo $error_message; ?>');
      <?php endif; ?>
    </script>

    <!--    script for validation-->
    <script>
      (function()
      {
        'use strict';
        window.addEventListener('load', function()
        {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form)
          {
            form.addEventListener('submit', function(event)
            {
              if (form.checkValidity() === false)
              {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
</div>
