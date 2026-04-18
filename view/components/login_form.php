<?php
    // Login form
    echo '<form action="controller/auth.php" method="POST">';
    echo '<h1>Login</h1>';
    echo '<label><p class="form_label">Username</p><input placeholder="" name="login_username"></label>';
    echo '<label><p class="form_label">Password</p><input type="password" placeholder="" name="login_password"></label>';
    echo '<input type="submit" name="form_login_submit" value="Login">';
    echo '</form>';
    echo '<div class="login_item"><div class="login_small">Don\'t have an account?</div><a class="login_link" href="create_account.php">Create account</a></div>'
?>