const loginTab = document.getElementById("login-tab-btn");
const registerTab = document.getElementById("register-tab-btn");

let loginTabActive = true;

loginTab.addEventListener("click", function () {
    loginTab.classList = 'tab tab-active';
    registerTab.classList = 'tab';
});

registerTab.addEventListener("click", function() {
    registerTab.classList = 'tab tab-active';
    loginTab.classList = 'tab';
});
