<div class="wrapper vh-98 p-5">
    <div class="row align-items-center h-100">
        <form action="<?php echo base_url('ProspectController/register'); ?>"
              method="post"
              class="col-lg-6 col-md-8 col-10 mx-auto needs-validation"
              novalidate>


            <div class="mx-auto text-center mt-5 flex">

                <h2 class="my-3">Créer un nouveau prospect</h2>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="first_name"
                           class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Nom</label>
                    <input type="text" id="lastname" name="last_name"
                           class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail4">E-mail</label>
                <input type="email" class="form-control" name="email"
                       id="inputEmail4" required>
                <div class="invalid-feedback text-left"> Please use a valid
                    email.
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Entreprise</label>
                    <input type="text" id="firstname" name="company"
                           class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Numéro téléphone</label>
                    <input type="tel" id="lastname" name="phone_number"
                           class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail4">Adresse</label>
                <textarea rows="5" class="form-control" name="address"
                          id="inputEmail4" required></textarea>
                <div class="invalid-feedback text-left"> Please use a valid
                    email.
                </div>
            </div>


            <button class="btn btn-lg btn-success btn-block green"
                    type="submit">Ajouter
            </button>
            <p class="mt-5 mb-3 text-muted text-center">© 2024</p>

        </form>
    </div>
</div>
