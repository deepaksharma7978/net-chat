const userObj = JSON.parse(localStorage.getItem("user"));
const url = `http://${window.location.host}`;

let currentChatPartnerId = -1;

// redirect to register page when user not logged in
if (!userObj) {
    window.location.href = "/register.php";
}

const emojiPicker = document.getElementById("emoji-picker");
const emojiPickerBtn = document.getElementById("emoji-picker-btn");

emojiPickerBtn.addEventListener("click", function () {
    emojiPicker.style.display = "block";
});

async function getMyChats() {
    const chatPageContainer = document.getElementById("chat-container");
    const chatProfilesContainer = document.getElementById("profiles-container");
    const nochatContainer = document.getElementById("nochat-page");

    const chatsResponse = await fetch(`${url}/api/my-chats?user_id=${userObj['id']}`, {
        method: 'GET',
    });

    if (chatsResponse.ok) {
        const chats_data = await chatsResponse.json();
        const chats = chats_data['data'];

        if (!chats.length) {
            chatPageContainer.style.display = "none";
            nochatContainer.style.display = "flex";
            return;
        }

        chats.forEach((chatProfile) => {
            chatProfilesContainer.insertAdjacentHTML("beforeend", `
                <div id="profile-${chatProfile['id']}" class="chat-profile">
                    <img src="./assets/profile.png" alt="User Profile" height="40px" width="40px">
                    <p>${chatProfile['fullname']}</p>
                </div>
            `);

            document.getElementById(`profile-${chatProfile['id']}`).addEventListener("click", function () {
                selectChat(chatProfile['id'], chatProfile['fullname'], chatProfile['email']);
            });
        });
    }
}

async function selectChat(user_id, fullname, email) {
    currentChatPartnerId = user_id;

    const nochat = document.getElementById("nochats-container");
    const chat = document.getElementById("chats-container");

    const chatUsername = document.getElementById("chat-username");
    const chatBox = document.getElementById("chat-box");

    chatBox.innerHTML = '';

    nochat.style.display = "none";
    chat.style.display = "flex";

    chatUsername.textContent = fullname;

    const chatsResponse = await fetch(`${url}/api/chats?sender_id=${userObj['id']}&receiver_id=${user_id}`, {
        method: 'GET',
    });

    if (chatsResponse.ok) {
        const chatsJson = await chatsResponse.json();
        const chats = chatsJson['data'];

        chats.forEach(chat => {
            if (chat['sender_id'] === userObj['id']) {
                chatBox.insertAdjacentHTML("beforeend", `
                    <div class="message-sent">${chat['message']}</div>
                `);
            } else {
                chatBox.insertAdjacentHTML("beforeend", `
                    <div class="message-receive">${chat['message']}</div>
                `);
            }
        });
    }
}

getMyChats();
