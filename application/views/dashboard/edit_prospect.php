<style>
    .centered-container {
        height: 98vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        width: 100%;
        max-width: 600px;
        margin-bottom: 150px;
    }

    .card h2 {
        text-align: center;
        margin-bottom: 30px;
        font-family: 'Arial', sans-serif;
        font-size: 24px;
        color: #343a40;
    }

    .form-group label {
        font-weight: bold;
        font-size: 14px;
        color: #495057;
    }

    .form-control {
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #007bff;
    }

    .btn-success {
        border-radius: 0.25rem;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        background-color: #32CD32;
        border-color: #32CD32;
    }

    .btn-success:hover {
        background-color: #228B22;
        border-color: #228B22;
    }

    .invalid-feedback {
        display: none;
    }

    .was-validated .form-control:invalid ~ .invalid-feedback {
        display: block;
    }
</style>
<div class="centered-container vh-98">
    <div class="card">
        <div class="mx-auto text-center mt-5 flex">
            <h3><i class="fas fa-user-edit"></i></h3>
            <h3 class="my-3"> Modifier un prospect</h3>
        </div>
        <form action="<?php echo base_url('ProspectController/edit_prospect/'.$prospects['id']); ?>" method="post"
              class="needs-validation" novalidate>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="first_name" class="form-control"
                           value="<?php echo set_value('first_name', $prospects['first_name']); ?>" required>
                    <div class="invalid-feedback text-left"> Please enter a first name.</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Nom</label>
                    <input type="text" id="lastname" name="last_name" class="form-control"
                           value="<?php echo set_value('last_name', $prospects['last_name']); ?>" required>
                    <div class="invalid-feedback text-left"> Please enter a last name.</div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail4">E-mail</label>
                <input type="email" class="form-control" name="email" id="inputEmail4"
                       value="<?php echo set_value('email', $prospects['email']); ?>" required>
                <div class="invalid-feedback text-left"> Please use a valid email.</div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="company">Entreprise</label>
                    <input type="text" id="company" name="company" class="form-control"
                           value="<?php echo set_value('company', $prospects['company']); ?>" required>
                    <div class="invalid-feedback text-left"> Please enter a company name.</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_number">Numéro téléphone</label>
                    <input type="tel" id="phone_number" name="phone_number" class="form-control"
                           value="<?php echo set_value('phone_number', $prospects['phone_number']); ?>" required>
                    <div class="invalid-feedback text-left"> Please enter a phone number.</div>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <textarea rows="5" class="form-control" name="address" id="address"
                          required><?php echo set_value('address', $prospects['address']); ?></textarea>
                <div class="invalid-feedback text-left"> Please enter a valid address.</div>
            </div>
            <button class="btn btn-lg btn-success btn-block green" type="submit">Modifier</button>

        </form>
    </div>
</div>
