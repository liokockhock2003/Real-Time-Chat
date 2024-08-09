<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login Page</title>
</head>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat</header>
            <form action="#" autocomplete = "off">
                <div class="error-txt">
                    
                </div>

                <div class="field input">
                    <label>Email Address</label>
                    <input type="email" name = "email" placeholder = "Email Address">
                </div>

                <div class="field input">
                    <label>Password</label>
                    <input type="password" name = "password" placeholder = "Password">
                    <i class="fa fa-eye"></i>
                </div>

                <div class="field button">
                    <input type="submit" value = "Login">
                </div>

                <div class="link">
                    Do not have an account yet? <a href="index.php">Sign up now</a>
                </div>
            </form>
        </section>
    </div>

    <script src = "javascript/pass-show-hide.js"></script>
    <script src = "javascript/login.js"></script>
</body>
</html>