const userObj = JSON.parse(localStorage.getItem("user"));
const url = `http://${window.location.host}`;

let currentChatPartnerId = -1;
let currentGroupId = -1;
let currentChatTab = 0;

let createGroupMemberList = [];

// redirect to register page when user not logged in
if (!userObj) {
    window.location.href = "/register.php";
}

const menuUsername = document.getElementById("menu-username");
const logoutBtn = document.getElementById("logout-btn");
const chatsTabBtn = document.getElementById("chats-tab");
const groupsTabBtn = document.getElementById("groups-tab");
const chatsProfileContainer = document.getElementById("profiles-container");
const createGroupSearchUserInput = document.getElementById("search-user-input-group-create");
const createGroupSearchUserBtn = document.getElementById("search-user-btn-group-create");
const createGroupBtn = document.getElementById("create-group-btn");
const createGroupCloseBtn = document.getElementById("create-group-close-btn");

menuUsername.textContent = userObj['fullname'];

logoutBtn.addEventListener("click", function () {
    localStorage.removeItem("user");

    window.location.href = "/register.php";
});

chatsTabBtn.addEventListener("click", function () {
    if (currentChatTab == 0) {
        return;
    }

    currentChatTab = 0;

    chatsProfileContainer.innerHTML = '';
    chatsTabBtn.style.backgroundColor = 'red';
    groupsTabBtn.style.backgroundColor = '#F7F9FC';

    getMyChats();
});

groupsTabBtn.addEventListener("click", function () {
    if (currentChatTab == 1) {
        return;
    }

    currentChatTab = 1;

    chatsProfileContainer.innerHTML = '';
    groupsTabBtn.style.backgroundColor = 'red';
    chatsTabBtn.style.backgroundColor = '#F7F9FC';

    getMyGroups();
});

createGroupSearchUserBtn.addEventListener("click", async function () {
    const userSearchInput = createGroupSearchUserInput.value;

    if (!userSearchInput) {
        return;
    }

    const userSearchResult = document.getElementById("create-group-results");
    userSearchResult.innerHTML = '';

    const searchResponse = await fetch(`${url}/api/user/search?query=${userSearchInput}`);

    if (searchResponse.ok) {
        const searchDataJson = await searchResponse.json();
        const searchData = searchDataJson.data;

        searchData.forEach(searchResult => {
            userSearchResult.insertAdjacentHTML("beforeend", `
                <div id="user-result-${searchResult['id']}" class="create-group-result">
                    <img src="./assets/profile.png" height="25px" width="25px">
                    <p>${searchResult['fullname']}</p>
                </div>
            `);

            document.getElementById(`user-result-${searchResult['id']}`).addEventListener("click", function () {
                const userAlreadyAdded = createGroupMemberList.find(userId => userId === searchResult['id']);

                if (userAlreadyAdded) {
                    createGroupMemberList = createGroupMemberList.filter(id => id !== searchResult['id']);
                    this.style.backgroundColor = '#F7F9FC';
                } else {
                    createGroupMemberList.push(searchResult['id']);
                    this.style.backgroundColor = '#E3F2FD';
                }
                console.log(createGroupMemberList);
            });
        });
    }
});

createGroupBtn.addEventListener("click", async function () {
    const groupName = document.getElementById("input-group-name-create");

    if (!groupName.value) {
        return;
    }

    if (!createGroupMemberList.length) {
        return;
    }

    createGroupMemberList.push(userObj['id']);

    const createGroupResponse = await fetch(`${url}/api/clubs/create`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            admin_id: userObj['id'],
            club_name: groupName.value,
            members: createGroupMemberList,
        }),
    });

    if (createGroupResponse.ok) {
        const createGroupJson = await createGroupResponse.json();
        console.log(createGroupJson);
    }
});

createGroupCloseBtn.addEventListener("click", function () {
    // reset on modal close

    const userSearchResult = document.getElementById("create-group-results");

    createGroupMemberList = [];
    createGroupSearchUserInput.value = '';

    userSearchResult.innerHTML = '';    
})

const emojiPicker = document.getElementById("emoji-picker");
const emojiPickerBtn = document.getElementById("emoji-picker-btn");

emojiPickerBtn.addEventListener("click", function () {
    emojiPicker.style.display = "block";
});

userSearchForm.addEventListener("submit",async function (e) {
    e.preventDefault();
    const userName = document.getElementById("user-search-input");
    console.log("userName", userName.value);

    if(!userName.value){
        return;
    }
    const userSearchRespone = await fetch(`${url}/api/user/search?query=${userName.value}`);

    if(userSearchRespone.ok){
        const searchUserDataJson = await userSearchRespone.json();
        console.log(searchUserDataJson);
    }
})

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

async function getMyGroups() {
    const chatPageContainer = document.getElementById("chats-container");
    const chatProfilesContainer = document.getElementById("profiles-container");
    const nochatContainer = document.getElementById("nochats-container");

    chatPageContainer.style.display = 'none';
    nochatContainer.style.display = 'flex';

    const groupsResponse = await fetch(`${url}/api/clubs?user_id=${userObj['id']}`, {
        method: 'GET',
    });

    if (groupsResponse.ok) {
        const groups_data = await groupsResponse.json();
        const groups = groups_data['data'];

        groups.forEach((group) => {
            chatProfilesContainer.insertAdjacentHTML("beforeend", `
                <div id="group-${group['club_id']}" class="chat-profile">
                    <img src="./assets/profile.png" alt="User Profile" height="40px" width="40px">
                    <p>${group['club_name']}</p>
                </div>
            `);

            document.getElementById(`group-${group['club_id']}`).addEventListener("click", function () {
                selectGroup(group['club_id'], group['club_name']);
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

async function selectGroup(group_id, group_name) {
    currentGroupId = group_id;

    const nochat = document.getElementById("nochats-container");
    const chat = document.getElementById("chats-container");

    const chatUsername = document.getElementById("chat-username");
    const chatBox = document.getElementById("chat-box");

    chatBox.innerHTML = '';

    nochat.style.display = "none";
    chat.style.display = "flex";

    chatUsername.textContent = group_name;

    const chatsResponse = await fetch(`${url}/api/clubs/chats?club_id=${group_id}`, {
        method: 'GET',
    });

    if (chatsResponse.ok) {
        const chatsJson = await chatsResponse.json();
        const chats = chatsJson['data'];

        chats.forEach(chat => {
            if (chat['sender_id'] === userObj['id']) {
                chatBox.insertAdjacentHTML("beforeend", `
                    <div class="message-sent group-chat">
                        <p class="sender-name">Me</p>
                        <p>${chat['message']}</p>
                    </div>
                `);
            } else {
                chatBox.insertAdjacentHTML("beforeend", `
                    <div class="message-receive group-chat">
                        <p class="sender-name">${chat['fullname']}</p>
                        <p>${chat['message']}</p>
                    </div>
                `);
            }
        });
    }
}

getMyChats();
