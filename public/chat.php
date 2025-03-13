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
            <img src="./assets/logo.png" alt="Net-chat Logo">
        </div>
         <div class="center">
            <input type="search" class="search-input" placeholder="Search....">
         </div>
         <div class="right">
            <img src="./assets/user.png" alt="User Logo">
        </div>
    </nav>

    <div class="chat-page-container">
        <div class="chat-profiles">
            <div class="chat-profile">
                <img src="./assets/profile.png" alt="User Profile" height="40px" width="40px">
                <p>Username</p>
            </div>
            <div class="chat-profile">
                <img src="./assets/profile.png" alt="User Profile" height="40px" width="40px">
                <p>Username</p>
            </div>
        </div>
        <div class="chats-container">
            <div class="Header">
                <div class="Profile">
                    <img src="./assets/profile.png" alt="User Profile" height="40px" width="40px">
                    <p> Username</p>
                </div>
                <div class="Add">
                    <button type="button">Add Friend</button>
                </div>
            </div>
            <div class="chat-box">
                <div class="message-sent">hii</div>
                <div class="message-receive">hru</div>
                <!-- <div class="message">
                    <div class="sender-site">
                            <div class="options">
                                <label for="options"></label>
                                    <select name="options" id="options">
                                    <option value="">👍</option>
                                    <option value="">😂</option>
                                    <option value="">😊</option>
                                    <option value="">🤗</option>
                                </select>
                                <div class="sender">
                                    <p>Hi</p>
                                </div>
                            </div>
                                <div class="receiver">
                                    <p>Hello</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="text-message">
                <emoji-picker id="emoji-picker" class="emoji-picker"></emoji-picker>
                <button id="emoji-picker-btn"></button>
                <input type="text" placeholder="Enter text..." class="input-field" >
                <button class="submit-button">Send</button>
            </div>
        </div>
    </div>
    <script src="./scripts/chat.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
</body>
</html>
