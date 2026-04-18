<?php
require "settings.php";
require "$controller_path/session_init.php";
require_once "$src_path/templates.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/styles.css">
    <link rel="stylesheet" href="src/index.css">
    <title>API projekt</title>
</head>
<body>
    <main>
        <?php
        $template->php("db", "$controller_path/auth.php", null);
        $template->php("db", "$controller_path/nav.php", null);
        $template->php("db", "$controller_path/metrics.php", null);
        $template->php("db", "$controller_path/listing.php", null);
        ?>
    </main>
</body>
</html>