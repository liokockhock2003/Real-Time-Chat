<?PHP 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Chat Page</title>
</head>
<body>

    <?php
        require_once "php/config.php";
        $user_id = mysqli_real_escape_string($conn, $_GET["user_id"]);
        $query = "SELECT * FROM users WHERE unique_id= ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0){
            $rows = mysqli_fetch_assoc($result);
        }
    ?>

    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="users.php" class="back-icon"><i class="fa fa-arrow-left"></i></a>
                <img src="images/<?php echo $rows['img']?>" alt="">
                <div class="details">
                    <span><?php echo $rows['fname'] ." ". $rows['lname'] ?></span>
                    <p><?php echo $rows['status']?></p>
                </div>
            </header>


            <div class="chat-box">
                

                
            </div>

            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name = "outgoing_id" value="<?php echo $_SESSION['unique_id']?>" hidden>
                <input type="text" name = "incoming_id" value="<?php echo $user_id?>" hidden>
                <input type="text" name = "message" class = "input-field" placeholder="Type a message here...">
                <button><i class="fa-regular fa-paper-plane"></i></button>
            </form>

        </section>
    </div>

    <script src = "javascript/chat.js"></script>
</body>
</html>