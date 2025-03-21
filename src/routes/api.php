<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/ChatsController.php';
require_once __DIR__ . '/../controllers/ClubsController.php';

header("Access-Control-Allow-Origin: *"); // Allow all origins (Change * to specific domain for security)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow headers
header("Access-Control-Allow-Credentials: true"); // Allow credentials (if needed)

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

Router::post('/api/user/login', function () {
    UserController::loginUser();
});

Router::post('/api/user/register', function () {
    UserController::registerUser();
});

Router::put('/api/user/delete', function () {
    UserController::deleteUser();
});

Router::get('/api/user/search', function() {
    UserController::searchUser();
});

Router::get('/api/chats', function () {
    ChatsController::get_chats();
});

Router::get('/api/my-chats', function () {
    ChatsController::get_my_chats();
});

Router::post('/api/clubs/create', function () {
    ClubsController::create_club();
});

Router::get('/api/clubs/chats', function () {
    ClubsController::get_chats();
});

Router::get('/api/clubs', function() {
    ClubsController::get_my_clubs();
});

Router::get('/api/clubs/member', function() {
    ClubsController::get_club_members();
});

Router::run();
