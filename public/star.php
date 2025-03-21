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
                <div class="curveShaped"></div>
                <div class="curveShaped2"></div>
                <form id="login-form" class="form-container Login">
                    <h3 class="animation" style="--D:0">Login</h3>
                    <div class="form-input animation" style="--D:1">
                        <input type="email" id="email" placeholder=" " autocomplete="username">
                        <label for="login-email">Email</label>
                        <i class='bx bx-user'></i>
                    </div>
                    <div class="form-input animation" style="--D:2">
                        <input type="password" id="password" placeholder=" " autocomplete="current-password">
                        <label for="login-password">Password</label>
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    <div class="input-btn animation" style="--D:3">
                        <button class="btn" type="submit">Login</button>
                    </div>

                    <div class="regis-link animation" style="--D:4">
                        <p>Don't have an account? <a href="#" class="signUpLink">Sign Up</a></p>
                    </div>
                </form>
                <div class="info-content login">
                    <h2 class="animation" style="--D:0">Welcome Back!</h2>
                    <p class="animation" style="--D:1">Welcome Back User!!</p>
                </div>

                <form id="register-form" class="form-container Register">
                    <h3 class="animation" style="--li:17;">Register</h3>
                    <div class="form-input animation">
                        <input type="text" id="register-name" placeholder=" " autocomplete="username">
                        <label for="register-name">Fullname</label>
                        <i class='bx bx-user'></i>
                    </div>
                    <div class="form-input animation " style="--li:18;">
                        <input type="email" id="register-email" placeholder=" " autocomplete="username">
                        <label for="register-email">Email</label>
                        <i class='bx bx-user'></i>
                    </div>
                    <div class="form-input animation" style="--li:19;">
                        <input type="password" id="register-password" placeholder=" " autocomplete="current-password">
                        <label for="register-password">Password</label>
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    <div class="input-btn animation" style="--li:20;">
                        <button class="btn" type="submit">Register</button>
                    </div>
                    
                    <div class="regis-link animation" style="--li:21;">
                        <p>Already have an account? <a href="#" class="signInLink">Sign In</a></p>
                    </div>
                </form>
                <div class="info-content Register">
                    <h2 class="animation" style="--li:17;">Welcome Back!</h2>
                    <p class="animation" style="--li:18;">Welcome Back User!!</p>
                </div>
            </div>
        </div>
    </div>
    <script src="./scripts/sky.js"></script>
</body>
</html>