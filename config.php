<?php
require_once __DIR__ . '/vendor/autoload.php'; // Ensure autoload.php is correctly required

// Load .env file from the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);  
$dotenv->load();

// Define database constants
define('DB_URL', $_ENV['DB_URL'] ?? '');
?>
