const loginTab = document.getElementById("login-tab-btn");
const registerTab = document.getElementById("register-tab-btn");

const loginForm = document.getElementById("login-form");
const registerForm = document.getElementById("register-form");

let loginTabActive = true;

// Set default visibility
loginForm.style.display = 'flex';
registerForm.style.display = 'none';

loginTab.addEventListener("click", function () {
    loginTab.classList = 'tab tab-active';
    registerTab.classList = 'tab';

    loginForm.style.display = 'flex';
    registerForm.style.display = 'none';
});

registerTab.addEventListener("click", function() {
    registerTab.classList = 'tab tab-active';
    loginTab.classList = 'tab';

    registerForm.style.display = 'flex';
    loginForm.style.display = 'none';
});

loginForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const email = document.getElementById("login-email");
    const password = document.getElementById("login-password");

    const loginData = {
        email: email.value,
        password: password.value,
    };

    const loginResponse = await fetch("http://localhost:8000/api/user/login", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(loginData),
    });

    if (loginResponse.ok) {
        
    } else {
        alert("Login Failed");
    }
});
