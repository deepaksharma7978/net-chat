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

        if (sentBy === currentChatPartnerId) {
            chatBox.insertAdjacentHTML("beforeend", `
                <div class="message-receive">${messageJson['message']}</div>
            `);
        } else {
            // notify user
        }
    }
});

chatSendBtn.addEventListener("click", function (e) {
    e.preventDefault();

    if (currentChatPartnerId < 0) {
        return;
    }

    if (!chatInput.value) {
        return;
    }

    socket.send(JSON.stringify({
        "event": "send-message",
        "userId": userObj['id'],
        "receiverId": currentChatPartnerId,
        "message": chatInput.value,
    }));

    chatBox.insertAdjacentHTML("beforeend", `
        <div class="message-sent">${chatInput.value}</div>
    `);

    chatInput.value = '';
});
