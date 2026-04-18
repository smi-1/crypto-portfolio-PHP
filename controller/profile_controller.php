<?php
require "settings.php";
require_once "$src_path/templates.php";

if (logged_in()) {
    global $template;
    $template->php('db', "$view_component_path/user_view.php", null);
}
