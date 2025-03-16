const wsUrl = `ws://localhost:80`;

const socket = new WebSocket(`${wsUrl}?user_id=${userObj['id']}`);

const chatInput = document.getElementById("chat-txt");
const chatSendBtn = document.getElementById("chat-send-btn");
const chatBox = document.getElementById("chat-box");

socket.addEventListener("error", function () {
    alert('Failed to connect server');
});

socket.addEventListener("message", function (event) {
    const messageJson = JSON.parse(event.data);

    if (messageJson.event === 'receive-message') {
        const sentBy = messageJson['sent_by'];
        const username = messageJson['fullname'];

        if (sentBy === currentChatPartnerId) {
            chatBox.insertAdjacentHTML("beforeend", `
                <div class="message-receive">${messageJson['message']}</div>
            `);
        } else {
            notifyMessage(username, messageJson.message);
        }
    }

    if (messageJson.event === 'receive-club-message') {
        const sentBy = messageJson['sender_id'];
        const groupId = messageJson['club_id'];
        const username = messageJson['fullname'];

        if (groupId === currentGroupId) {
            chatBox.insertAdjacentHTML("beforeend", `
                <div class="message-receive group-chat">
                    <p class="sender-name">${messageJson['fullname']}</p>
                    <p>${messageJson['message']}</p>
                </div>
            `);
        } else {
            notifyMessage(username, messageJson.message);
        }
    }
});

chatSendBtn.addEventListener("click", function (e) {
    e.preventDefault();

    if (currentChatTab === 0 && currentChatPartnerId < 0) {
        return;
    }

    if (currentChatTab === 1 && currentGroupId < 0) {
        return;
    }

    if (!chatInput.value) {
        return;
    }

    if (currentChatTab === 0) {
        socket.send(JSON.stringify({
            "event": "send-message",
            "userId": userObj['id'],
            "fullname": userObj['fullname'],
            "receiverId": currentChatPartnerId,
            "message": chatInput.value,
        }));

        chatBox.insertAdjacentHTML("beforeend", `
            <div class="message-sent">${chatInput.value}</div>
        `);
    }

    if (currentChatTab === 1) {
        socket.send(JSON.stringify({
            "event": "send-club-message",
            "senderId": userObj['id'],
            "fullname": userObj['fullname'],
            "clubId": currentGroupId,
            "message": chatInput.value,
        }));

        chatBox.insertAdjacentHTML("beforeend", `
            <div class="message-sent group-chat">
                <p class="sender-name">Me</p>
                <p>${chatInput.value}</p>
            </div>
        `);
    }

    chatInput.value = '';
});

function notifyMessage(username, message) {
    // Notify user
    if (!("Notification" in window)) {
        return;
    } else if (Notification.permission === "granted") {
        // Check whether notification permissions have already been granted;
        // if so, create a notification
        const notification = new Notification(`Net Chat - ${username}`, {
            body: message.substr(0, 10) + '...'
        });
    } else if (Notification.permission !== "denied") {
        // We need to ask the user for permission
        Notification.requestPermission().then((permission) => {
            // If the user accepts, let's create a notification
            if (permission === "granted") {
                const notification = new Notification(`Net Chat - ${username}`, {
                    body: message.substr(0, 10) + '...'
                });
            }
        });
    }
}
