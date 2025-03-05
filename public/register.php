<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Net Chat - Register</title>
    <link rel="stylesheet" href="./styles/register.css">
    <link rel="stylesheet" href="./styles/global.css">
</head>

<body>
    <div class="main-container">
        <div class="tabs-container">
            <div class="tab-btns">
                <div id="login-tab-btn" class="tab tab-active">Login</div>
                <div id="register-tab-btn" class="tab">Register</div>
            </div>
            <div class="login-cards">
                <form id="login-form" class="form-container">
                    <h3>Login</h3>
                    <div class="form-input">
                        <label for="login-email">Email</label>
                        <input type="email" id="login-email" placeholder="john@doe.com">
                    </div>
                    <div class="form-input">
                        <label for="login-password">Password</label>
                        <input type="password" id="login-password" placeholder="John#90abc">
                    </div>
                    <button type="submit">
                        Login
                    </button>
                </form>
                <form id="register-form" class="form-container">
                    <h3>Register</h3>
                    <div class="form-input">
                        <label for="register-name">Fullname</label>
                        <input type="text" id="register-name" placeholder="John Doe">
                    </div>
                    <div class="form-input">
                        <label for="register-email">Email</label>
                        <input type="email" id="register-email" placeholder="john@doe.com">
                    </div>
                    <div class="form-input">
                        <label for="register-password">Password</label>
                        <input type="password" id="register-password" placeholder="John#90abc">
                    </div>
                    <button type="submit">
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="./scripts/register.js"></script>
</body>

</html>