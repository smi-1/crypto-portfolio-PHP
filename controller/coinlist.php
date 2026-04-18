<?php
require "settings.php";
require_once "$src_path/templates.php";
require_once "$model_path/api.php";
$symbol = "BTC";

$data = $api->get_price($symbol);
if ($data) {
    global $template;
    $price = htmlspecialchars(number_format($data['data']['BTC'][0]['quote']['USD']['price'], 4, '.' , ''));
    $template->php('db', "$view_component_path/price_table.php", ['price' => $price]);
}
?>