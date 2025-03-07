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

    <div class="Chat-history-container">
        <div class="chat-history">
            <div class="User">Prabhat
            </div>
        </div>
        <div class="chat-view"></div>
    </div>

    <script src="./scripts/chat.js"></script>
</body>
</html>
