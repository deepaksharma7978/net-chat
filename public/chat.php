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
    <!-- include bootstrap styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body onload="getMyChats()">
    <nav>
        <div class="left">
            <img src="./assets/logo-back.jpg" alt="Net-chat Logo">
        </div>
         <div class="center">
            <input type="search" class="search-input" placeholder="Search....">
        </div>
        <div class="right">
            <!-- Button trigger modal -->
            <button type="button" id="add-grp-btn" class="btn btn-light chat-tab" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Create Group
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" id="create-group-close-btn" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="create-group-body">
                                <input id="input-group-name-create" placeholder="Group name">
                                <div class="create-group-user-search">
                                    <input id="search-user-input-group-create" placeholder="Search user by name or email">
                                    <button id="search-user-btn-group-create">Search</button>
                                </div>
                                <div id="create-group-results" class="create-group-results">
                                    <!-- display search profiles -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="create-group-btn">Create Group</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="./assets/user.png" alt="User Logo" height="40px" width="40px">
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-item" id="menu-username">Username</li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-item" id="logout-btn">Log out</li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- displayed when user have not started chatting with anyone -->
    <div id="nochat-page">
        <p>Start chatting by searching a user</p>
    </div>

    <div id="chat-container" class="chat-page-container">
        <div class="chat-profiles">
            <div class="chat-tab-selector">
                <span id="chats-tab" class="chat-tab chat-tab-active">Chats</span>
                <span id="groups-tab" class="chat-tab">Groups</span>
            </div>
            <!-- Profiles will be displayed here dynamically -->
            <div id="profiles-container"></div>
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
                <input id="chat-txt" type="text" placeholder="Enter text..." class="input-field">
                <button id="chat-send-btn" class="submit-button">Send</button>
            </div>
        </div>
    </div>
    <script src="./scripts/chat.js"></script>
    <script src="./scripts/socket_handler.js"></script>
    <!-- emoji picker script -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
    <!-- include bootstrap scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>