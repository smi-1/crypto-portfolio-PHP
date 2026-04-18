<?php
    // Account creation form
    echo '<form action="controller/auth.php" method="POST">';
    echo '<h1>Create account</h1>';
    echo '<label><p class="form_label">Username</p><input placeholder="" name="create_username"></label>';
    echo '<label><p class="form_label">Password</p><input type="password" placeholder="" name="create_password"></label>';
    echo '<label><p class="form_label">Email</p><input type="text" placeholder="" name="create_email"></label>';
    echo '<input type="submit" name="form_create_submit" value="Create">';
    echo '</form>';
?>