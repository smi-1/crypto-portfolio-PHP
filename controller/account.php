<?php

require_once  __DIR__ . "/../settings.php";
require_once  __DIR__ . "/../$model_path/db.php";

// Account creation
function create_account($db, $username, $password_hash, $email)
{
    /* SQL prepared statements for account creation
    binds sanitized and regexed parameters and executes the statement
    */
    $query = "INSERT INTO users(username, password, email) VALUES (?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $username, $password_hash, $email);
    $stmt->execute();
    header('Location: ../index.php');
}

// Account login
function handle_login($db, $username, $password)
{
    try {
        session_start();
        /* SQL prepared statements for login
        binds sanitized and regexed parameters and executes the statement
        */
        $query = "SELECT username,password,id FROM users WHERE username=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($username === $user['username'] && password_verify($password, $user['password'])) {
            // Cookie settings
            $cookie_options = [
                // Cookie timeout
                'expires' => time() + 3600,
                'secure' => false, // HTTPS only, using false in dev mode
                'httponly' => true, // true = can't access the cookie with JS
                'samesite' => 'Lax' // Dev mode
            ];
            // Sets a cookie
            setcookie('user_logged_in', 'yes', $cookie_options);
            $_SESSION['id'] = $user['id'];
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            if (!isset($_SESSION['init_hemlig_variabel'])) {
                // Regenerate session id
                session_regenerate_id(true);
                // An extra variable to keep track of a users login
                $_SESSION['init_hemlig_variabel'] = 1;
            }
            header('Location: ../index.php');
        } else {
            echo "login credentials wrong";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
// Logout
function logout()
{
    /*
    Clears cookie and destroys the session
    */
    session_start();
    session_destroy();
    $_SESSION = array();
    setcookie('user_logged_in', 'yes', time() - 99);
    header('Location: ../index.php');
    exit;
}
// Check if a user is logged in
function logged_in()
{
    if (isset($_SESSION['init_hemlig_variabel']) && isset($_SESSION["logged_in"])) {
        return true;
    } else {
        return false;
    }
}
