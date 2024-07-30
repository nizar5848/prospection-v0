<style>
    .profile-card {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        background-color: #fff;
    }

    .profile-card h2 {
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

    .btn-primary {
        border-radius: 0.25rem;
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }

    .form-text {
        font-size: 12px;
        color: #6c757d;
    }

    .card-icon {
        font-size: 50px;
        text-align: center;
        margin-bottom: 15px;
    }

    /* Default colors */
    .card-icon.default {
        color: #007bff;
    }

    .btn-primary.default {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary.default:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* User colors */
    .card-icon.user {
        color: #32CD32;
    }

    .btn-primary.user {
        background-color: #32CD32;
        border-color: #32CD32;
    }

    .btn-primary.user:hover {
        background-color: #228B22;
        border-color: #228B22;
    }
</style>

<div class="container">
    <div class="card profile-card">
        <div class="card-icon <?= $user['role'] == 'user' ? 'user' : 'default' ?>">
            <i class="fas fa-user-circle"></i>
        </div>
        <h2>Profile</h2>
        <form action="<?= base_url('DashboardController/update_profile') ?>" method="post">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                       value="<?= $user['first_name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                       value="<?= $user['last_name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text">Leave blank to keep current password.</small>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            <button type="submit" class="btn btn-primary <?= $user['role'] == 'user' ? 'user' : 'default' ?>">Update Profile</button>
        </form>
    </div>
</div>
