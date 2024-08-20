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

    .phone-number-group {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .phone-number-group input {
        margin-right: 10px;
        flex: 1;
    }

    .phone-number-group button {
        background: #dc3545;
        border: none;
        color: white;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>
<div class="centered-container vh-98">
    <div class="card">
        <div class="mx-auto text-center mt-5 flex">
            <h3><i class="fas fa-user-edit"></i></h3>
            <h3 class="my-3"> Modifier un prospect</h3>
        </div>
        <form action="<?php echo base_url('ProspectController/edit_prospect/'.$prospect['id']); ?>" method="post"
              class="needs-validation" novalidate>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="first_name" class="form-control"
                           value="<?php echo set_value('first_name', $prospect['first_name']); ?>" required>
                    <div class="invalid-feedback text-left"> Please enter a first name.</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Nom</label>
                    <input type="text" id="lastname" name="last_name" class="form-control"
                           value="<?php echo set_value('last_name', $prospect['last_name']); ?>" required>
                    <div class="invalid-feedback text-left"> Please enter a last name.</div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail4">E-mail</label>
                <input type="email" class="form-control" name="email" id="inputEmail4"
                       value="<?php echo set_value('email', $prospect['email']); ?>" required>
                <div class="invalid-feedback text-left"> Please use a valid email.</div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="company">Entreprise</label>
                    <input type="text" id="company" name="company" class="form-control"
                           value="<?php echo set_value('company', $prospect['company']); ?>" required>
                    <div class="invalid-feedback text-left"> Please enter a company name.</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_numbers">Numéro téléphone</label>
                    <div id="phone-numbers-container">
                        <!-- Existing phone numbers will be populated here -->
                    </div>
                    <button type="button" class="btn btn-primary blue" onclick="addPhoneNumber()">
                        Ajouter un numéro
                    </button>
                    <div class="invalid-feedback text-left"> Please enter at least one phone number.</div>
                </div>
                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" id="ville" name="ville" class="form-control"
                           value="<?php echo set_value('ville', $prospect['ville']); ?>" required>
                    <div class="invalid-feedback text-left">Veuillez saisir la ville.</div>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <textarea rows="5" class="form-control" name="address" id="address"
                          required><?php echo set_value('address', $prospect['address']); ?></textarea>
                <div class="invalid-feedback text-left"> Please enter a valid address.</div>
            </div>
            <button class="btn btn-lg btn-success btn-block green" type="submit">Modifier</button>
        </form>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var phoneNumbers = <?php echo json_encode($prospect['phone_numbers']); ?>;
    var container = document.getElementById('phone-numbers-container');

    phoneNumbers.forEach(function(phoneNumber) {
      addPhoneNumberField(phoneNumber);
    });
  });

  function addPhoneNumber() {
    addPhoneNumberField('');
  }

  function addPhoneNumberField(value) {
    var container = document.getElementById('phone-numbers-container');
    var group = document.createElement('div');
    group.className = 'phone-number-group';

    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'phone_number[]';
    input.className = 'form-control';
    input.placeholder = 'Numéro de téléphone';
    input.value = value;

    var button = document.createElement('button');
    button.type = 'button';
    button.textContent = 'Supprimer';
    button.onclick = function() {
      container.removeChild(group);
    };

    group.appendChild(input);
    group.appendChild(button);
    container.appendChild(group);
  }
</script>
