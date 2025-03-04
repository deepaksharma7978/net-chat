<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Net Chat</title>
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/global.css">
</head>

<body>
    <?php
    require_once __DIR__ . '/../src/db.php';
    $db = connect_sql_db();
    $user = $_COOKIE['user'];

    if ($user == NULL) {
        header('Location: register.php');
    }
    ?>
</body>

</html>