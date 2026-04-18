<?php
require "settings.php";
require_once "$src_path/templates.php";
require_once "$model_path/api.php";

global $api;
/* 
    Getting listing information from API and sanitizing output
*/
$data = $api->get_listing_latest();
if ($data) {
    $total_top_100 = 0;
    $total_top_100_volume = 0;
    $total_top_100_market_cap = 0;
    $output = array();
    global $template;
    foreach ($data['data'] as $value) {
        $id = htmlspecialchars($value['id']);
        $name = htmlspecialchars($value['name']);
        $symbol = htmlspecialchars($value['symbol']);
        $price = htmlspecialchars(number_format($value['quote']['USD']['price'], 3, '.', ''));
        $total_top_100 += $price;
        $volume = htmlspecialchars(number_format($value['quote']['USD']['volume_24h'], 3, '.', ''));
        $market_cap = htmlspecialchars(number_format($value['quote']['USD']['market_cap'], 3, '.', ''));
        $total_top_100_volume += $volume;
        $total_top_100_market_cap += $market_cap;
        $percent_change_1h = htmlspecialchars(number_format($value['quote']['USD']['percent_change_1h'], 2, '.', ''));
        $percent_change_1h_color = htmlspecialchars(($percent_change_1h > 0)) ? "listing_green" : "listing_red";
        $percent_change_24h = htmlspecialchars(number_format($value['quote']['USD']['percent_change_24h'], 2, '.', ''));
        $percent_change_24h_color = htmlspecialchars(($percent_change_24h > 0)) ? "listing_green" : "listing_red";
        $percent_change_7d = htmlspecialchars(number_format($value['quote']['USD']['percent_change_7d'], 2, '.', ''));
        $percent_change_7d_color = htmlspecialchars(($percent_change_7d > 0)) ? "listing_green" : "listing_red";
        array_push($output, ['id'=>$id,'name'=>$name,'symbol'=>$symbol,'price'=>$price,'percent_change_1h'=>$percent_change_1h,'percent_change_24h'=>$percent_change_24h,'percent_change_7d'=>$percent_change_7d, 'percent_change_1h_color'=>$percent_change_1h_color, 'percent_change_24h_color'=>$percent_change_24h_color, 'percent_change_7d_color'=>$percent_change_7d_color]);
    }
    $total_top_100_volume = htmlspecialchars(number_format(($total_top_100_volume / 1000000000000), 3, '.',''));
    $total_top_100_market_cap = htmlspecialchars(number_format(($total_top_100_market_cap / 1000000000000), 3, '.',''));
    $template->php('db', "$view_component_path/listing_table.php", ['output'=>$output, 'total_top_100'=>$total_top_100, 'total_top_100_volume'=>$total_top_100_volume, 'total_top_100_market_cap'=>$total_top_100_market_cap]);
}
?>