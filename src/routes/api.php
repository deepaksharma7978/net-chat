<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/ChatsController.php';
require_once __DIR__ . '/../controllers/ClubsController.php';

header("Content-Type: application/json");
// CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');

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
