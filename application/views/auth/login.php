<style>
        .alert-card {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            width: 300px;
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
<div class="wrapper vh-100">
    <?php if ($this->session->flashdata('error')): ?>
        <div id="errorAlert" class="alert alert-danger alert-dismissible fade show alert-card" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
    <div class="row align-items-center h-100">
        <?php echo form_open('AuthController/login', [
            'class'      => 'col-lg-3 col-md-4 col-10 mx-auto text-center needs-validation',
            'novalidate' => true,
        ]); ?>
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
        <h1 class="h6 mb-3">Connexion</h1>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">e-mail</label>
            <input type="email" id="inputEmail" name="email"
                   class="form-control form-control-lg" placeholder="e-mail"
                   value="<?php echo set_value('email'); ?>" required autofocus>
            <div class="invalid-feedback text-left"> Please use a valid email </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="sr-only">Mot de passe</label>
            <input type="password" id="inputPassword" name="password"
                   class="form-control form-control-lg" placeholder="Mot de passe" required>
            <div class="invalid-feedback text-left"> utiliser un mot de passe correct </div>
        </div>
        <?php if ( ! $is_admin_exists): ?>
            <div class="checkbox mb-3">
                <a href="<?php echo base_url('register'); ?>">Créer admin</a>
            </div>
        <?php endif; ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
        <p class="mt-5 mb-3 text-muted">© 2024</p>
        <?php echo form_close(); ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
