<?php
require_once __DIR__ . '/../config.php';

$ssl_cert_path = __DIR__ . '/../cert/ca.pem';

function connect_sql_db() {
    $uri = DB_URL;

    $fields = parse_url($uri);
    $database = ltrim($fields["path"], '/'); // Extract DB name

    $ssl_ca = $GLOBALS['ssl_cert_path']; // Ensure this file exists

    // Check if SSL file exists
    if (!file_exists($ssl_ca)) {
        die("Error: SSL certificate not found at " . $ssl_ca);
    }

    // Build DSN with SSL
    $conn = "mysql:";
    $conn .= "host=" . $fields["host"];
    $conn .= ";port=" . $fields["port"];
    $conn .= ";dbname=" . $database;
    $conn .= ";sslmode=verify-ca;sslrootcert=" . $ssl_ca;

    try {
        $db = new PDO($conn, $fields["user"], $fields["pass"], [
            // PDO::MYSQL_ATTR_SSL_CA => $ssl_ca, // Explicit SSL option
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        $stmt = $db->query("SELECT VERSION()");

        return $db;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
