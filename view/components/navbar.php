<?php
require "settings.php";
// Navigation bar
echo '<nav>';
echo '<div class="nav_left"><a href="index.php"><div class="logo">Koin</div></a></div>';
echo '<div class="nav_links">';
echo '<a class="nav_link" href="index.php">Listing</a>';
echo '<a class="nav_link" href="portfolio.php">Portfolio</a>';
echo '</div>';
// if user is logged in echo user profile link and log out link else login link
echo '<div class="nav_right">';
if (!logged_in()) { echo '<a href="login.php">Log in</a>'; } else {
    echo '<a href="user.php"><div class="user_btn"><div class="user_img"></div>';
    echo ''.$_SESSION['username'].'</div></a>';
    echo '<form class="nav_form" action="'.$controller_path.'/auth.php" method="POST"><button name="logout" class="nav_button">Logout</button></form>';
}
echo '</div>';
echo '</nav>';

?>