<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        header("location: users.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Sign up Page</title>
</head>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat</header>
            <form action="#" enctype = "multipart/form-data">
                <div class="error-txt">
                    
                </div>

                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder = "First Name" required>
                    </div>

                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder = "Last Name" required>
                    </div>
                </div>

                <div class="field input">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder = "Email Address" required>
                </div>

                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder = "Password" required>
                    <i class="fa fa-eye"></i>
                </div>

                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="image" required>
                </div>

                <div class="field button">
                    <input type="submit" value = "Sign Up">
                </div>

                <div class="link">
                    Already signed up? <a href="login.php">Login now</a>
                </div>
            </form>
        </section>
    </div>

    <script src = "javascript/pass-show-hide.js"></script>
    <script src = "javascript/signup.js"></script>
</body>
</html>