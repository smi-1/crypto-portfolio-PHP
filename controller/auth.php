<?php

require __DIR__ . "/../settings.php";
require __DIR__ . "/../$model_path/api.php";
require __DIR__ . "/../$controller_path/account.php";

/* Handle account creation form input
   Validating and sanitizing
*/
if (isset($_POST['form_create_submit']) && 
    isset($_POST['create_username']) && 
    isset($_POST['create_password']) && 
    isset($_POST['create_email'])) {
    $username = trim($_POST['create_username']);
    $password_hash = password_hash(trim($_POST['create_password']), PASSWORD_DEFAULT);
    $email = trim($_POST['create_email']);
    if (preg_match('/^[a-zA-Z0-9]+$/',$username) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        create_account($db, $username, $password_hash, $email);
    } else {
        header('Location: ../create_account.php');
    }
}
/* Handle account login form input
   Validating and sanitizing
*/
if (
    isset($_POST['form_login_submit']) && 
    isset($_POST['login_username']) && 
    isset($_POST['login_password'])) {
    $username = trim($_POST['login_username']);
    $password = trim($_POST['login_password']);
    if (preg_match('/^[a-zA-Z0-9]+$/',$username)) {
        handle_login($db, $username, $password);
    } else {
        header('Location: ../login.php');
    }
}

/* Handle account logout
*/
if (isset($_POST['logout'])) {
    logout();
}

?>