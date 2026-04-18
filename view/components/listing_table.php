<?php
global $CMC_currency_icon;
global $CMC_currency_icon_type;
// Main listing table
echo '<div class="listing_buttons"><button>Listing</button><button>Portfolio view</button>';
echo '<div class="spacer"></div>';
echo '<div class="market_info_item_2"><p class="market_label_2">Top 100 market cap</p><p class="market_label_num_2">'.$total_top_100_market_cap.'T</p></div>';
echo '<div class="market_info_item_2"><p class="market_label_2">Top 100 volume 24h</p><p class="market_label_num_2">'.$total_top_100_volume.'T</p></div>';
echo '</div>';
echo '<table class="listing"><tr><th>Name</th><th>Price</th><th>% 1h</th><th>% 24h</th><th>% 7d</th></tr>';
foreach ($output as $currency) {
    echo '
        <tr>
            <td>
            <div class="td_wrapper">
                <img class="currency_icon" src=' . $CMC_currency_icon, $currency['id'], $CMC_currency_icon_type . '>
                <p class="listing_name">'. $currency['name'] .'</p>
                <p class="list_symbol">' . $currency['symbol'] . '</p>
            </div>
            </td>
            <td><span class="td_span">$</span> ' . $currency['price'] . '</td>
            <td class='.$currency['percent_change_1h_color'].'>' . $currency['percent_change_1h'] . '</td>
            <td class='.$currency['percent_change_24h_color'].'>' . $currency['percent_change_24h'] . '</td>
            <td class='.$currency['percent_change_7d_color'].'>' . $currency['percent_change_7d'] . '</td>
        </tr>';
}
echo '</table>';
