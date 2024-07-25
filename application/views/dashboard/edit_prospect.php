<div class="wrapper vh-98 ">
    <div class="row align-items-center h-100">
        <form action="<?php echo base_url('ProspectController/edit_prospect/' . $prospects['id']); ?>"
              method="post"
              class="col-lg-6 col-md-8 col-10 mx-auto needs-validation"
              novalidate>

            <div class="mx-auto text-center mt-5 flex">
                <h2 class="my-3">Modifier un prospect</h2>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="first_name"
                           class="form-control" value="<?php echo set_value('first_name', $prospects['first_name']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Nom</label>
                    <input type="text" id="lastname" name="last_name"
                           class="form-control" value="<?php echo set_value('last_name', $prospects['last_name']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail4">E-mail</label>
                <input type="email" class="form-control" name="email"
                       id="inputEmail4" value="<?php echo set_value('email', $prospects['email']); ?>" required>
                <div class="invalid-feedback text-left"> Please use a valid email.</div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="company">Entreprise</label>
                    <input type="text" id="company" name="company"
                           class="form-control" value="<?php echo set_value('company', $prospects['company']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_number">Numéro téléphone</label>
                    <input type="tel" id="phone_number" name="phone_number"
                           class="form-control" value="<?php echo set_value('phone_number', $prospects['phone_number']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <textarea rows="5" class="form-control" name="address"
                          id="address" required><?php echo set_value('address', $prospects['address']); ?></textarea>
                <div class="invalid-feedback text-left"> Please use a valid address.</div>
            </div>

            <button class="btn btn-lg btn-success btn-block green" type="submit">Modifier</button>
            <p class="mt-5 mb-3 text-muted text-center">© 2024</p>

        </form>
    </div>
</div>
