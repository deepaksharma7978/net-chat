<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../controllers/UserController.php';

header("Content-Type: application/json");

Router::post('/api/user/login', function() {
    UserController::loginUser();
});

Router::post('/api/user/register', function() {
    UserController::registerUser();
});

Router::put('/api/user/delete', function() {
    UserController::deleteUser();
});

Router::run();
?>