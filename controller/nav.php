<?php

require "settings.php";
require_once "$src_path/templates.php";
global $template;

$template->php("db", "$view_component_path/navbar.php", null);

?>