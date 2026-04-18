<?php
require "settings.php";
/*
    Porfolio currency list handler
*/
if (logged_in()) {
    /* SQL prepared statements for currencies in portfolio
    binds sanitized and regexed parameters and executes the statement
    */
    $userid = trim($_SESSION['id']);
    $query = "SELECT c.symbol, c.name, c.api_id, ph.amount, c.id as coin_id
        FROM portfolio_holdings ph
        JOIN coins c ON ph.coin_id = c.id
        WHERE ph.user_id = ? AND ph.amount > 0 
        ORDER BY ph.amount DESC";
    global $db;
    global $api;
    global $template;
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $res = $stmt->get_result();
    $result = array();

    // Data for individual owned currencies
    foreach ($res as $value) {
        $api_id = $value['api_id'];
        $data = $api->get_price($api_id);
        $price = number_format(htmlspecialchars($data['data'][$api_id]['quote']['USD']['price']), 3, '.', '');
        $amount = number_format(htmlspecialchars($value['amount']), 10, '.', '');
        $total_value = number_format(htmlspecialchars($amount) * ($price), 3, '.', '');
        $name = htmlspecialchars($value['name']);
        $symbol = htmlspecialchars($value['symbol']);
        $coin_id = htmlspecialchars($value['coin_id']);
        array_push($result, ['symbol' => $symbol, 'name' => $name, 'amount' => $amount, 'coin_id' => $coin_id, 'total_value' => $total_value, 'price' => $price]);
    }

    // Data for adding more (getting listing)
    $data = $api->get_listing_latest();
    $listing = array();

    foreach ($data['data'] as $value) {
        $name = htmlspecialchars($value['name']);
        $coin_id = htmlspecialchars($value['id']);
        array_push($listing, ['coin_id' => $coin_id, 'name' => $name]);
    }

    $template->php("db", "$view_component_path/portfolio_view.php", ['results' => $result, 'listing' => $listing]);
} else {
    header('Location: login.php');
}
