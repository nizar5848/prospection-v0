<style>
    .centered-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        margin-top: 20px;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        width: 100%;
        max-width: 600px;
        margin-bottom: 20px;
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
            <h3 class="my-3">Modifier les informations du prospect</h3>
        </div>
        <form action="<?php echo base_url('ProspectController/edit_prospect/'.$prospect['id']); ?>" method="post"
              class="needs-validation" novalidate>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="first_name" class="form-control"
                           value="<?php echo set_value('first_name', $prospect['first_name']); ?>" required>
                    <div class="invalid-feedback text-left">Veuillez entrer un prénom.</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Nom</label>
                    <input type="text" id="lastname" name="last_name" class="form-control"
                           value="<?php echo set_value('last_name', $prospect['last_name']); ?>" required>
                    <div class="invalid-feedback text-left">Veuillez entrer un nom.</div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail4">E-mail</label>
                <input type="email" class="form-control" name="email" id="inputEmail4"
                       value="<?php echo set_value('email', $prospect['email']); ?>" required>
                <div class="invalid-feedback text-left">Veuillez utiliser un e-mail valide.</div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="company">Entreprise</label>
                    <input type="text" id="company" name="company" class="form-control"
                           value="<?php echo set_value('company', $prospect['company']); ?>" required>
                    <div class="invalid-feedback text-left">Veuillez entrer le nom de l'entreprise.</div>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_numbers">Numéro téléphone</label>
                    <div id="phone-numbers-container">
                        <!-- Existing phone numbers will be populated here -->
                    </div>
                    <button type="button" class="btn btn-primary blue" onclick="addPhoneNumber()">
                        Ajouter un numéro
                    </button>
                    <div class="invalid-feedback text-left">Veuillez entrer au moins un numéro de téléphone.</div>
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
                <div class="invalid-feedback text-left">Veuillez entrer une adresse valide.</div>
            </div>
            <!-- Interests Section -->
            <div class="form-group interest-section">
                <label for="interets">Intérêts</label>

                <!-- Predefined Interests -->
                <div class="row">
                    <?php
                    // Predefined interests
                    $predefined_interests = ['Site Web', 'Marketing Digital', 'SEO', 'Logiciel de gestion'];

                    // Ensure existing interests are an array
                    $json_string = $prospect['interets']; // This should be a JSON-encoded string

                    // Decode the JSON string
                    //                    $existing_interests = json_decode(json_decode($json_string, true));

                    //                    var_dump($existing_interests);

                    if (is_array($json_string)) {
                        // If it's already an array, no need to decode
                        $existing_interests = $json_string;
                    } else {
                        // If it's a JSON string, decode it
                        $decoded_data = json_decode($json_string, true);

                        // If the first decoding gives an array, use it directly
                        if (is_array($decoded_data)) {
                            $existing_interests = $decoded_data;
                        } else {
                            // If the first decoding returns a string, decode it again
                            $existing_interests = json_decode($decoded_data, true);
                        }
                    }
                    if ( ! is_array($existing_interests)) {
                        $existing_interests = [];
                    }
                    ?>

                    <?php foreach ($predefined_interests as $index => $interest): ?>
                        <div class="col-md-6">
                            <div class="interest-checkbox">
                                <input type="checkbox" name="interets[]" value="<?php echo $interest; ?>"
                                       id="interest<?php echo $index; ?>"
                                    <?php echo in_array($interest, $existing_interests) ? 'checked' : ''; ?>>
                                <label for="interest<?php echo $index; ?>"><?php echo $interest; ?></label>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Custom Interests -->
                    <?php foreach ($existing_interests as $custom_interest): ?>
                        <?php if ( ! in_array($custom_interest, $predefined_interests)): ?>
                            <div class="col-md-6">
                                <div class="interest-checkbox">
                                    <input type="checkbox" name="interets[]" value="<?php echo $custom_interest; ?>"
                                           id="custom-interest<?php echo md5($custom_interest); ?>"
                                           checked>
                                    <label for="custom-interest<?php echo md5($custom_interest); ?>"><?php echo $custom_interest; ?></label>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Added Interests -->
                <div id="additional-interest-fields" class="row">
                    <!-- Dynamically added interests will appear here -->
                </div>

                <!-- Add New Interest -->
                <div class="additional-interests">
                    <label for="new-interest">Ajouter un nouvel intérêt</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="new_interest[]" placeholder="Nouvel intérêt">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary add-interest-btn" type="button"
                                    title="Ajouter un autre intérêt">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- send asigned to the same as the current one -->

            <input type="hidden" name="assigned_to" value="<?php echo $prospect['assigned_to'] ?>">
            <!-- send asigned to the same as the current one -->

            <!-- Other form fields here -->
            <?php if ($this->session->userdata('role') === 'admin'): ?>
                <div class="form-group">
                    <label for="assigned_to">Assigné à</label>
                    <select id="assigned_to" name="assigned_to" class="form-control" required>
                        <option value="">Sélectionnez un commercial</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['id']; ?>" <?php echo ($prospect['assigned_to'] == $user['id']) ? 'selected' : ''; ?>>
                                <?php echo $user['first_name'].' '.$user['last_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback text-left">Veuillez sélectionner un commercial.</div>
                </div>
            <?php endif; ?>
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
    button.textContent = 'x';
    button.onclick = function() {
      container.removeChild(group);
    };

    group.appendChild(input);
    group.appendChild(button);
    container.appendChild(group);
  }

  // Handle adding new interests dynamically
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.add-interest-btn').addEventListener('click', function() {
      var newInterest = document.querySelector('input[name="new_interest[]"]').value;
      if (newInterest) {
        var additionalFields = document.getElementById('additional-interest-fields');
        var div = document.createElement('div');
        div.className = 'col-md-6';  // Ensure it fits the grid layout
        div.innerHTML = `<div class="interest-checkbox">
                            <input type="checkbox" name="interets[]" value="${newInterest}" id="new-interest-${Date.now()}" checked>
                            <label for="new-interest-${Date.now()}">${newInterest}</label>
                         </div>`;
        additionalFields.appendChild(div);
        document.querySelector('input[name="new_interest[]"]').value = '';
      }
    });

    // Handle removal of unchecked custom interests
    document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        if (!this.checked) {
          var customInterestsField = document.getElementById('additional-interest-fields');
          if (customInterestsField) {
            customInterestsField.querySelectorAll('input[type="checkbox"]').forEach(function(cb) {
              if (cb.value === checkbox.value) {
                cb.parentElement.parentElement.remove();  // Remove entire column div
              }
            });
          }
        }
      });
    });
  });
</script>
