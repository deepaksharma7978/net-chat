<?php
$baseUrl = '/assets/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Net-chat</title>
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/chat.css">
</head>
<body>
    <nav>
        <div class="left">
            <img src="./assets/logo-back.jpg" alt="Net-chat Logo">
        </div>
        <form id="user-search-form" class="center">
            <input type="search" class="search-input" placeholder="Search...." id="user-search-input">
        </form>
        <div id="searchResults"></div>
        <div class="right">
            <img src="./assets/user.png" alt="User Logo">
        </div>
    </nav>

    <!-- displayed when user have not started chatting with anyone -->
    <div id="nochat-page">
        <p>Start chatting by searching a user</p>
    </div>

    <div id="chat-container" class="chat-page-container">
        <div id="profiles-container" class="chat-profiles">
            <!-- Profiles will be displayed here dynamically -->
        </div>

        <!-- display when chat not selected -->
        <div id="nochats-container">
            <p>Select a chat</p>
        </div>

        <div id="chats-container">
            <div class="Header">
                <div class="Profile">
                    <img src="./assets/profile.png" alt="User Profile" height="40px" width="40px">
                    <p id="chat-username">Username</p>
                </div>
                <div class="Add">
                    <button type="button">Add Friend</button>
                </div>
            </div>
            <div id="chat-box" class="chat-box">
                <!-- dynamically load chats here -->
            </div>
            <div class="text-message">
                <emoji-picker id="emoji-picker" class="emoji-picker"></emoji-picker>
                <button id="emoji-picker-btn"></button>
                <input id="chat-txt" type="text" placeholder="Enter text..." class="input-field" >
                <button id="chat-send-btn" class="submit-button">Send</button>
            </div>
        </div>
    </div>
    <script src="./scripts/chat.js"></script>
    <script src="./scripts/socket_handler.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
</body>
</html>
