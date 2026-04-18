<?php

    require __DIR__ . "/../settings.php";
    require_once __DIR__ . "/../$src_path/templates.php";

    global $template;
    $template->php("db", "$view_component_path/login_form.php", null);
    
?>