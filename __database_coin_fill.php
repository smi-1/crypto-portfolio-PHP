<?php
require "settings.php";
require_once "$model_path/db.php";
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
    <title>Add coins to coins table</title>
</head>

<body>
    <?php
    require_once "$model_path/api.php";
    $data = $api->get_listing_latest();
    // RUN ONLY ONCE, GETS TOP 100 COINS AND ADDS TO coins TABLE
    foreach ($data['data'] as $value) {
        $symbol = $value['symbol'];
        $name = $value['name'];
        $api_id = $value['id'];
        $query = "INSERT INTO coins(symbol, name, api_id) VALUES (?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssi', $symbol, $name, $api_id);
        //$stmt->execute();
    }
    ?>
</body>

</html>