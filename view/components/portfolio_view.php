<?php
require "settings.php";
global $api;
// Main portfolio view

// Dashboard, add coins
echo '<section class="portfolio_dash">';
echo '<div class="portfolio_item">';
echo '<form class="add_coin_form" action="'.$controller_path.'/handle_portfolio.php" method="POST">';
echo '<select class="add_coin" name="add_coin_select">';
foreach ($listing as $value) {
    echo '<option name="add_coin_option" value='.$value['coin_id'].'>';
    echo $value['name'];
    echo '</option>';
}
echo '</select>';
echo '<input type="text" name="add_amount" class="add_amount">';
echo '<input type="submit" name="add_submit" class="add_submit" value="Add coin">';
echo '</form>';
echo '</div>';
echo '</section>';
// Portfolio listing table of owned currencies
echo '<table>';
echo '<tr><th>id</th><th>Name</th><th>Price</th><th>Value</th><th>Amount</th><th></th></tr>';
foreach ($results as $value) {
    echo '<tr>';
    echo '<td>'.$value['coin_id'].'</td>';
    echo '<td>'.$value['name'].'</td>';
    echo '<td class="td_price">'.$value['price'].'</td>';
    echo '<td>$ '.$value['total_value'].'</td>';
    echo '<td>'.$value['amount'].' '.$value['symbol'].'</td>';
    echo '<td class="portfolio_modify">';
    echo '<form class="menu" method="POST" action="'.$controller_path.'/handle_portfolio.php">';
    echo '<input type="text" name="modify_amount" value="'.$value['amount'].'">';
    echo '<input type="hidden" name="modify_coin_id" value="'.$value['coin_id'].'">';
    echo '<input type="submit" value="Save" name="modify_submit">';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}