<?php
session_start();
require __DIR__ . "/../settings.php";
require_once  __DIR__ . "/../$model_path/db.php";

/* Handle portfolio adding new coin form input
   Validating and sanitizing
*/
if (
    isset($_SESSION['id']) &&
    isset($_POST['add_submit']) &&
    isset($_POST['add_coin_select']) &&
    isset($_POST['add_amount'])
) {
    $user_id = $_SESSION['id'];
    if (preg_match('/^[0-9.]+$/', $_POST['add_amount'])) {
        /* SQL prepared statements for adding a new coin
        binds sanitized and regexed parameters and executes the statement
        */
        $api_id = trim($_POST['add_coin_select']);
        $amount = (float)trim($_POST['add_amount']);
        $query = "SELECT id FROM coins WHERE api_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $api_id);
        $stmt->execute();
        $result = $stmt->get_result();
        // Add new coin
        if ($coin = $result->fetch_assoc()) {
            $coin_id = htmlspecialchars($coin['id']); // Use internal ID
            $insert_query = "INSERT INTO portfolio_holdings (user_id, coin_id, amount)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE amount = amount + VALUES(amount)";
            $insert_stmt = $db->prepare($insert_query);
            $insert_stmt->bind_param("iid", $user_id, $coin_id, $amount);
            $insert_stmt->execute();
        }
    }
    header('Location: ../portfolio.php');
}
/* Handle portfolio modifying owned coin amount form input
   Validating and sanitizing
*/
if (
    isset($_SESSION['id']) &&
    isset($_POST['modify_amount']) &&
    isset($_POST['modify_coin_id']) &&
    isset($_POST['modify_submit'])
) {
    if (preg_match('/^[0-9.]+$/', $_POST['modify_amount']) && preg_match('/^[0-9]+$/', $_POST['modify_coin_id'])) {
        /* SQL prepared statements for changing owned coin amount or 
        removing coin from the portfolio if amount is set to 0
        binds sanitized and regexed parameters and executes the statement
        */
        $amount = (float)trim($_POST['modify_amount']);
        $coin_id = trim($_POST['modify_coin_id']);
        $user_id = $_SESSION['id'];
        // Delete
        if ($amount == 0) {
            $query = 'DELETE FROM portfolio_holdings WHERE user_id=? AND coin_id=?';
            $stmt = $db->prepare($query);
            $stmt->bind_param("ii", $user_id, $coin_id);
            $stmt->execute();
        } 
        // Modify amount
        else {
            $query = "UPDATE portfolio_holdings SET amount = ? WHERE user_id = ? AND coin_id = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("dii", $amount, $user_id, $coin_id);
            $stmt->execute();
        }
    }
    header('Location: ../portfolio.php');
}
