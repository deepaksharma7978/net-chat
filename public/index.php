<?php
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/routes/api.php';

$db = connect_sql_db();
$user = null;

if (isset($_COOKIE['user'])) {
    $GLOBALS['user'] = $_COOKIE['user'];
    header('Location: /chat.php');
    exit();
} else {
    header('Location: /register.php');
    exit();
}
?>