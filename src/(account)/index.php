<!DOCTYPE html>
<html lang="en">
<?php
require_once '../php/requirements.php';
if (!is_user_logged_in()) {
    error_and_reroute('please login into an account to view accounts page', '../(login)/');
}
$user = fetch_cookie('user');
?>
<head>
    <?= render_header('account') ?>
</head>
<body>
    <?= render_navbar() ?>

    <main class="account">
        <form action="update_account_info.php" class="account-form" method="post">
            <div class="email-input">
                <label for="email" class="label">email</label>
                <input type="email" name="email" id="email" required value="<?= $user['email'] ?>">
            </div>

            <div class="name-input">
                <label for="username" class="label">name</label>
                <input type="username" name="username" id="username" required value="<?= $user['username'] ?>">
            </div>
            
            <div class="password-input">
                <label for="password" class="label">password</label>
                <input type="password" name="password" id="password" required value="<?= $user['password'] ?>">
            </div>

            <div class="password-conf-input">
                <label for="password-conf" class="label">confirm password</label>
                <input type="password-conf" name="password-conf" id="password-conf" required value="<?= $user['password'] ?>">
            </div>

            <button type="button" onclick="togglePasswords(['password', 'password-conf'])">toggle password</button>

            <div class="img-url-input">
                <label for="img-url">profile picture</label>
                <input type="file" name="img-url" id="img-url" value="upload" placeholder="../assets/images/placeholder-profile.jpg" value="<?= $user['img_url'] ?>">
            </div>

            
            <!-- displays an error message if one is applicable -->
            <?php
            // checks there is an error message to give
            if (isset($_COOKIE['tmp_error_message'])): ?>
                <p class="medium-error"><?= fetch_cookie(name: 'tmp_error_message', unset_value: true) ?></p>
            <?php endif; ?>

            <div class="account-options">
                <input class="primary-button" type="submit" value="Update">
                <div class="secondary-button">
                    <a href="logout.php">logout</a>
                </div>
                <button type="button" class="delete-button" onclick="togglePopup('delete-account')">Delete account</button>
            </div>
        </form>

        <div class="popup" id="delete-account" hidden>
            <h1>Delete account</h1>
            <button type="button" class="close-button" onclick="togglePopup('delete-account');">X</button>
            <a href="delete_account.php" class="delete-button">Delete account</a>
            <button type="button" class="secondary-button" onclick="togglePopup('delete-account');">cancel</button>
        </div>
    </main>

    <script src="../js/scripts.js"></script>
</body>
</html>