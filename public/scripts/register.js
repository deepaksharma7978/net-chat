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

registerTab.addEventListener("click", function () {
    registerTab.classList = 'tab tab-active';
    loginTab.classList = 'tab';

    registerForm.style.display = 'flex';
    loginForm.style.display = 'none';
});

loginForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const email = document.getElementById("login-email");
    const password = document.getElementById("login-password");

    if (!email.value) {
        alert("Enter email");
        return;
    }

    if (!password.value || password.value.length < 8) {
        alert("Enter valid password");
        return;
    }

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
        const loginResponseData = await loginResponse.json();
        console.log(loginResponseData);


        email.value = '';
        password.value = '';

        localStorage.setItem("user", JSON.stringify({ id: loginResponseData.data.id, email: loginResponseData.data.email, fullname: loginResponseData.data.fullname }));
        window.location.href = "/chat.php";
    } else {
        const { message } = await loginResponse.json();
        alert(message);
    }
});

registerForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const fullname = document.getElementById("register-name");
    const email = document.getElementById("register-email");
    const password = document.getElementById("register-password");

    if (!fullname.value) {
        alert("Please enter your name");
        return;
    }

    if (!email.value) {
        alert("Enter email");
        return;
    }

    if (!password.value || password.value.length < 8) {
        alert("Enter a valid password");
        return;
    }

    const registerData = {
        email: email.value,
        password: password.value,
        fullname: fullname.value,
    };

    const registerResponse = await fetch("http://localhost:8000/api/user/register", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(registerData),
    });

    if (registerResponse.ok) {
        const registerResponseData = await registerResponse.json();

        alert(registerResponseData.message);
    } else {
        const { message } = await registerResponse.json();
        alert(message);
    }
});
