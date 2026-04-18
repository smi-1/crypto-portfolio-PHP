<?php
require "settings.php";
require_once "$src_path/templates.php";
require_once "$model_path/api.php";

global $api;
/* 
    Getting global metric information from API and sanitizing output
*/
$data = $api->get_metrics();
if ($data) {
    $output = array();
    global $template;
    $total_market_cap = htmlspecialchars(number_format(($data['data']['quote']['USD']['total_market_cap'] / 1000000000000), 2, '.', ''));
    $total_market_cap_yesterday = htmlspecialchars(number_format(($data['data']['quote']['USD']['total_market_cap_yesterday'] / 1000000000000), 2, '.', ''));
    $total_volume_24h = htmlspecialchars(number_format(($data['data']['quote']['USD']['total_volume_24h'] / 1000000000), 2, '.', ''));
    $total_volume_24h_yesterday = htmlspecialchars(number_format(($data['data']['quote']['USD']['total_volume_24h_yesterday'] / 1000000000000), 2, '.', ''));
    $template->php("db", "$view_component_path/metrics_module.php", ['total_market_cap'=>$total_market_cap, 'total_market_cap_yesterday'=>$total_market_cap_yesterday, 'total_volume_24h'=>$total_volume_24h, 'total_volume_24h_yesterday'=>$total_volume_24h_yesterday]);
}

?>