<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Intro</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="./styles/register.css"> -->
    <link rel="stylesheet" href="./styles/sky.css">
</head>
<body>
        <div class="main-container">
            <section class="wrapper">
                <div id="stars"></div>
                <div id="stars2"></div>
                <div id="stars3"></div>
            </section>
            <!-- <div class="tabs-container">
                <div class="tab-btns">
                <div id="login-tab-btn" class="tab tab-active">Login</div>
                <div id="register-tab-btn" class="tab">Register</div> 
            </div> -->
            <div class="login-cards">
                <form id="login-form" class="form-container Login">
                    <h3>Login</h3>
                    <div class="form-input">
                        <input type="email" id="email" placeholder=" " autocomplete="username">
                        <label for="login-email">Email</label>
                        <i class='bx bx-user'></i>
                    </div>
                    <div class="form-input">
                        <input type="password" id="password" placeholder=" " autocomplete="current-password">
                        <label for="login-password">Password</label>
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    <div class="input-btn">
                        <button class="btn" type="submit">Login</button>
                    </div>

                    <div class="regis-link">
                        <p>Don't have an account? <a href="#" class="signUpLink">Sign Up</a></p>
                    </div>
                </form>
                <!-- <form id="register-form" class="form-container">
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
                </form> -->
            </div>
            <div class="info-content">
                <h2>Welcome Back!</h2>
                <p>Welcome Back User!!</p>
            </div>
        </div>
    </div>
</body>
</html>