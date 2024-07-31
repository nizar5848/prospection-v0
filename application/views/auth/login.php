<style>
/* Card Styling */
.card {
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    width: 600px;
    max-width: 600px;
    margin: 0 auto; /* Center horizontally */
    border: 1px solid #e0e0e0;
    overflow: hidden; /* Ensure border-radius affects all corners */
    position: relative; /* Ensure card is the container for absolute positioning */
    margin-left:50px;
}

/* Alert Card Styling */
.alert-card {
    position: fixed; /* Fixes the position relative to the viewport */
    top: 8px; /* Adjust the top offset as needed */
    left: 50%; /* Center horizontally */
    transform: translateX(-50%); /* Center horizontally */
    z-index: 1000;
    width: 300px; /* Set width */
    padding: 15px; /* Add padding for content spacing */
    height: auto; /* Adjust height based on content */
    opacity: 0; /* Start hidden */
    animation: swingInOut 4s forwards; /* Apply animation */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for depth */
    background-color: #f8d7da; /* Light red background */
    color: #721c24; /* Dark red text */
}

@keyframes swingInOut {
    0% { opacity: 0; transform: translateX(-50%) rotateX(-90deg); }
    10% { opacity: 1; transform: translateX(-50%) rotateX(0deg); }
    90% { opacity: 1; transform: translateX(-50%) rotateX(0deg); }
    100% { opacity: 0; transform: translateX(-50%) rotateX(-90deg); }
}



.vh-100 {
    height: 100vh;
}

.wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full viewport height */
}


    </style>
  <div class="wrapper vh-100">
    <?php if ($this->session->flashdata('error')): ?>
        <div id="errorAlert" class="alert alert-danger alert-dismissible fade show alert-card card" role="alert">
            <div class="card-body">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-6 col-md-8 col-12">
            <div class="card">
                <div class="card-body text-center">
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
                    <?php echo form_open('AuthController/login', [
                        'class'      => 'needs-validation',
                        'novalidate' => true,
                    ]); ?>
                    <div class="form-group">
                        <label for="inputEmail" class="sr-only">e-mail</label>
                        <input type="email" id="inputEmail" name="email"
                               class="form-control form-control-lg" placeholder="e-mail"
                               value="<?php echo set_value('email'); ?>" required autofocus>
                        <div class="invalid-feedback text-left">Veuillez utiliser un email valide.</div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="sr-only">Mot de passe</label>
                        <input type="password" id="inputPassword" name="password"
                               class="form-control form-control-lg" placeholder="Mot de passe" required>
                        <div class="invalid-feedback text-left">Utiliser un mot de passe correct.</div>
                    </div>
                    <?php if ( ! $is_admin_exists): ?>
                        <div class="checkbox mb-3">
                            <a href="<?php echo base_url('register'); ?>">Créer un compte admin</a>
                        </div>
                    <?php endif; ?>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
                    <p class="mt-5 mb-3 text-muted">© 2024</p>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
